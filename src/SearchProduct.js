import React, { useState, useEffect } from 'react';
import { Table } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
import { useStateValue } from './StateProvider';
import { Cart } from './Cart';

function SearchProduct() {
  const [data, setData] = useState([]);
  const [{}, dispatch] = useStateValue();
  const navigate = useNavigate();

  useEffect(() => {
    fetchData();
  }, []);

  async function fetchData() {
    try {
      const response = await fetch('http://localhost:8000/api/listProduct', {
        method: 'GET',
      });
      if (!response.ok) {
        throw new Error('Failed to fetch data');
      }
      const result = await response.json();
      setData(result);
    } catch (error) {
      console.error(error);
    }
  }

  async function deleteOperation(id) {
    try {
      const response = await fetch(`http://localhost:8000/api/delete/${id}`, {
        method: 'DELETE',
      });

      if (!response.ok) {
        throw new Error('Failed to delete data');
      }

      const result = await response.json();
      console.warn(result);

      // Call fetchData() again to update the data after deletion
      fetchData();
    } catch (error) {
      console.error(error);
    }
  }

  function addToCart(product) {
    dispatch({
      type: 'ADD_TO_BASKET',
      item: {
        id: product.id,
        title: product.name,
        image: `http://localhost:8000/${product.file_path}`,
        price: product.price,
        rating: 0, // Set the rating as needed
      },
    });
  }

  async function submitCart() {
    try {
      const response = await fetch('http://localhost:8000/cart/submit', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
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

  async function search(key) {
    try {
      console.warn(key);
      const result = await fetch(`http://localhost:8000/api/search/${key}`);
      const data = await result.json();
      console.warn(data);
      setData(data);
    } catch (error) {
      console.error(error);
    }
  }

  return (
    <div>
      <h1>Search Results</h1>
      <br />
      <div className="col-sm-6 offset-sm-2">
        <input
          type="text"
          onChange={(e) => search(e.target.value)}
          className="form-control"
          placeholder="Search Product"
        />
      </div>
      <div className="col-sm-8 offset-sm-2"> {/* Center the table */}
        <Table align="center" className="table">
          <thead align="center" bgcolor="green">
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Price</th>
              <th>Brand</th>
              <th>Description</th>
              <th>Availability</th>
              <th>Image</th>
              <th>Operation</th>
            </tr>
          </thead>
          <tbody>
            {data.map((item) => (
              <tr key={item.id}>
                <td>{item.id}</td>
                <td>{item.name}</td>
                <td bgcolor="cyan">KSH {item.price}</td>
                <td>{item.brand}</td>
                <td>{item.description}</td>
                <td>{item.availability}</td>
                <td style={{ width: 20 }}>
                  <img
                    src={`http://localhost:8000/${item.file_path}`}
                    alt="Product"
                    onClick={() => addToCart(item)}
                    style={{ cursor: 'pointer' }}
                  />
                </td>
                <td>
                  <span className="delete" onClick={() => deleteOperation(item.id)}>
                    DELETE
                  </span>
                </td>
                <td>
                  <Link to={`updateProduct/${item.id}`}>
                    <span className="update">UPDATE</span>
                  </Link>
                </td>
              </tr>
            ))}
          </tbody>
          <tfoot>
            <tr>
              <td align="center" colSpan={8}> {/* Center the button */}
                <button onClick={submitCart}>Place Order Now</button>
              </td>
            </tr>
          </tfoot>
        </Table>
      </div>
    </div>
  );
}

export default SearchProduct;
