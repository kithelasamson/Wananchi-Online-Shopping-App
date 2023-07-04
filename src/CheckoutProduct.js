import React from "react";
import { useStateValue } from "./StateProvider";
import star from "./images/group.png";
import "./CheckoutProduct.css";
import { NumberFormatBase } from 'react-number-format';

function CheckoutProduct({ id, title, image, price, rating }) {
  const [{ basket }, dispatch] = useStateValue();

  const removeFromBasket = () => {
    dispatch({
      type: "REMOVE_FROM_BASKET",
      id: id,
    });
  };

  return (
    <div className="CheckoutProduct">
      <NumberFormatBase
        renderText={(formattedValue) => (
          <div>
            <img className="CheckoutProduct_image" src={image} alt="" />

            <div className="CheckoutProduct_info">
              <p className="CheckoutProduct_title">{title}</p>
              <p className="CheckoutProduct_price">
                <small>KSH: </small>
                <strong>{formattedValue}</strong>
              </p>
              <div className="CheckoutProduct_rating">
                {Array(rating)
                  .fill()
                  .map((_) => (
                    <img
                      key={Math.floor(Math.random() * 156)}
                      src={star}
                      alt=""
                    />
                  ))}
              </div>
              <p className="Checkout_button" onClick={removeFromBasket}>
                REMOVE
              </p>
            </div>
          </div>
        )}
        decimalScale={2}
        value={price}
        displayType="text"
        thousandSeparator={false}
        prefix="KSH: "
      />
    </div>
  );
}

export default CheckoutProduct;
