import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import Header from './Header';

function UpdateProduct() {
  const { id } = useParams();
  const [data, setData] = useState({});

  useEffect(() => {
    fetchData();
  }, []);

  async function fetchData() {
    try {
      const response = await fetch(`http://localhost:8000/api/product/${id}`);
      if (!response.ok) {
        throw new Error('Failed to fetch data');
      }
      const result = await response.json();
      setData(result);
    } catch (error) {
      console.error(error);
    }
  }

  return (
    <div>
      <Header />
      <h1>Update Product Page</h1>
      <input type="text" defaultValue={data.id} /><br /><br />
      <input type="text" defaultValue={data.name} /><br /><br />
      <input type="text" defaultValue={data.price} /><br /><br />
      <input type="text" defaultValue={data.quantity} /><br /><br />
      <input type="text" defaultValue={data.brand} /><br /><br />
      <input type="text" defaultValue={data.description} /><br /><br />
      <input type="text" defaultValue={data.availability} /><br /><br />
      <img style={{ width: 100 }} src={`http://localhost:8000/${data.file_path}`} alt="Product" />
      <button>Update Product</button>
    </div>
  );
}

export default UpdateProduct;
