import React, { useEffect, useState } from 'react';
import { useStateValue } from './StateProvider';

function Subtotal() {
  const [{ basket }] = useStateValue();
  const [subtotal, setSubtotal] = useState(0);

  useEffect(() => {
    calculateSubtotal();
  }, [basket]);

  const calculateSubtotal = () => {
    let total = 0;
    basket.forEach((item) => {
      total += parseFloat(item.price);
    });
    setSubtotal(total);
  };

  return (
    <div className="subtotal">
      <p>
        Subtotal ({basket.length} items): <strong>KSH {subtotal.toFixed(2)}</strong>
      </p>
      <small className="subtotal_gift">
        <input type="checkbox" />
        This order contains a gift
      </small>
      <button type="button">CHECKOUT</button>
    </div>
  );
}

export default Subtotal;
