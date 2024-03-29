<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\BasketStoreRequest;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add(Request $request, Product $product): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $quantity = $request->input('quantity') ?? 1;
        if (empty($basketId)) {
            // если корзина еще не существует — создаем объект
            $basket = Basket::query()->create();
            $quantity = $basket->products()->updateExistingPivot(
                'product_id',
                ['quantity', $quantity]
            );// должен обновлять количество этого товара именно в этой корзине
            // получаем идентификатор, чтобы записать в cookie
            $basketId = $basket->id;
        } else {
            // корзина уже существует, получаем объект корзины
            $basket = Basket::findOrFail($basketId);
            // обновляем поле `updated_at` таблицы `baskets`
            $basket->touch();
        }
        if ($basket->products->contains($product)) {
            // если такой товар есть в корзине — изменяем кол-во
            $pivotRow = $basket->products()->where('product_id', $product)->first()->pivot;
            $quantity = $pivotRow->quantity + $quantity;
            $pivotRow->update(['quantity' => $quantity]);
        } else {
            // если такого товара нет в корзине — добавляем его
            $basket->products()->attach($product, ['quantity' => $quantity]);
        }
        // выполняем редирект обратно на страницу, где была нажата кнопка «В корзину»
        return back()->withCookie(cookie('basket_id', $basketId, 525600));
    }

    /**
     * Увеличивает кол-во товара $id в корзине на единицу
     */
    public function plus(Request $request, int $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        if (empty($basketId)) {
            abort(404);
        }
        $this->change($basketId, $id, 1);
        // выполняем редирект обратно на страницу корзины
        return redirect()
            ->route('basket.index')
            ->withCookie(cookie('basket_id', $basketId, 525600));
    }

    /**
     * Уменьшает кол-во товара $id в корзине на единицу
     */
    public function minus(Request $request, int $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        if (empty($basketId)) {
            abort(404);
        }
        $this->change($basketId, $id, -1);
        // выполняем редирект обратно на страницу корзины
        return redirect()
            ->route('basket.index')
            ->withCookie(cookie('basket_id', $basketId, 525600));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BasketStoreRequest $request): Basket
    {
        $data = $request->validated();

        $image = $data ['image'];
        $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $image->move(
            storage_path() . '/app/public/basket/images',
            $imageName
        );

        $basket = new Basket();

//        $basket->name = $data['name'];
//        $basket->image = $imageName;
//        $basket->description = $data['description'];
        $basket->price = $data['price'];
        $basket->quantity = $data['quantity'];

        $basket->save();

        return $basket;
    }

    /**
     * Display the specified resource.
     */
    public function show(basket $basket)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(basket $basket)
    {
        //
    }

    public function remove($id): RedirectResponse
    {
        $this->basketId->remove($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }

    /**
     * Полностью очищает содержимое корзины покупателя
     */
    public function clear(): RedirectResponse
    {
        $this->basketId->delete();
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
}
