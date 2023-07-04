import React, { useState, useEffect, fetchData } from 'react';
import { Table } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
 
 function Cart()
 {
  const [data, setData] = useState([]);
  const navigate = useNavigate();
  useEffect(() => { fetchData()}, []);

async function addToCart(productId) 
{

    try {
      const response = await fetch('http://localhost:8000/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: productId}),
      });

      if (!response.ok) {
        throw new Error('Failed to add product to cart');
      }

      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.error(error);
    }  
  }
  async function submitCart() {
    try {
      const response = await fetch('http://localhost:8000/cart/submit', {
        method: 'POST',
      });

      if (!response.ok) {
        throw new Error('Failed to submit cart');
      }

      const data = await response.json();
      console.log(data);
      // Redirect the user to the checkout page
      navigate('/checkout');
    } catch (error) {
      console.error(error);
    }
  }


 return Cart();
}
export  default Cart;