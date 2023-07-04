import React from "react";
import { useStateValue } from "./StateProvider";
import Subtotal from "./Subtotal";
import "./Checkout.css";
import CheckoutProduct from "./CheckoutProduct"; // Import the modified CheckoutProduct component

function Checkout() {
  const [{ basket }] = useStateValue();

  return (
    <div className="checkout">
      <div className="checkout_left">
        {/* The rest of your component code */}
        {basket?.length === 0 ? (
          <div>
            <h2>Your cart is empty</h2>
            <p>Add an item to your cart</p>
            <Subtotal total={0} />
          </div>
        ) : (
          <div className="items">
            <h2 className="checkout_title">Your Shopping Cart</h2>
            {basket?.map((item) => (
              <CheckoutProduct
                key={item.id}
                id={item.id}
                title={item.title}
                image={item.image}
                price={item.price}
                rating={item.rating}
              />
            ))}
            <Subtotal />
          </div>
        )}
      </div>
    </div>
  );
}

export default Checkout;
