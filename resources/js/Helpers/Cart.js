"use strict"

/**
 * Cart Items Structure
 * [{ product_id:, product_option_id:, qty }]
 */
export const addCart = (product_id, product_option_id, qty) => {
    let cart = localStorage.getItem("cart");
    if(cart == null) cart = [];
    else {
        //Check if item already exists
        if(searchCart(product_id, product_option_id)) return false;
    }
    
    const item = { id: product_id, qty, product_option_id };
    cart.push(item);

    return true;
};

export const searchCart = () => {
    let cart = localStorage.getItem("cart");
    if(cart === null) return false;

};

export const removeCart = () => {

};