<?php

class Cart {

    public function add(Product $product)
    {
        $inCart = false;
        $this->setTotal($product);
        if (count($this->getCart()) > 0) 
        {
            foreach($this->getCart() as $productInCart){
                if ($productInCart->getId() === $product->getId()) {
                    $quantity = $productInCart->getQuantity() + $product->getQuantity();
                    $productInCart->setQuantity($quantity);
                    $inCart = true;
                    break;
                }
            }
        }
        if (!$inCart) {
            $this->setProductsInCart($product);
        }
    } 

    private function setProductsInCart($product){
        $_SESSION['cart']['products'][] = $product;
    }

    private function setTotal(Product $product){
        $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity(); 
    }

    public function remove()
    {

    }

    public function getCart()
    {
        return $_SESSION['cart']['products'] ?? [];
    }
}