<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 15:49
 */
class ShoppingCartLibrary
{
    private $cart;
    private $count;

    public function __construct()
    {
        if (isset($_SESSION['cart']))
            $this->cart = $_SESSION['cart'];//Lay tu session
        else $this->cart = $_SESSION['cart'] = array();
        $this->count = $this->countItem();
    }

    public function countItem()
    {
        return count($this->cart);
    }

    public function addItem($item = array())
    {
        $index = $this->count;
        $check = 0;
        for ($i = 0; $i < $index; $i++) {
            if ($item['code'] == $this->cart[$i]['code']) {
                $this->cart[$i]['qty'] += max(1, intval($item['qty']));
                $check = 1;
                break;
            }
        }
        if ($check == 0) {
            $this->cart[$index]['code'] = $item['code'];
            $this->cart[$index]['name'] = $item['name'];
            $this->cart[$index]['image'] = $item['image'];
            $this->cart[$index]['qty'] = max(1, intval($item['qty']));
            $this->cart[$index]['price'] = $item['price'];
        }
        $_SESSION['cart'] = $this->cart;//Dua len session
    }

    public function updateItem($item= array())
    {
        for ($i = 0; $i < $this->count; $i++) {
            $this->cart[$i]['qty'] = max(1, intval($item[$i]));
        }
        $_SESSION['cart'] = $this->cart;
    }

    public function deleteItem($id)
    {
        for ($i = $id; $i < $this->count - 1; $i++) {
            $next = $i + 1;
            $this->cart[$i] = $this->cart[$next];
        }
        unset($this->cart[$this->count - 1]);
        $_SESSION['cart'] = $this->cart;

    }

    public function total() {
        $result = 0;
        for ($i = 0; $i < $this->count; $i++)
            $result += $this->cart[$i]['qty'] * $this->cart[$i]['price'];
        return $result;
    }
    public function content() {
        return $this->cart;
    }
    public function destroy() {
        unset($_SESSION['cart']);
    }
}