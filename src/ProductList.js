import React, { useState, useEffect } from 'react';
import { Table } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
import { useStateValue } from './StateProvider';
import { Cart } from './Cart';
import SearchProduct from './SearchProduct';

function ProductList() {
  const [data, setData] = useState([]);
  const navigate = useNavigate();
  const [{ basket }, dispatch] = useStateValue();

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
      const response = await fetch('http://localhost:8000/cart/submit',{
        method: 'POST',
        'Content-Type':'application/json',
        'Accept':'json',
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

  return (
    <div>
      <h1>Most Recent Purchased Products</h1>
      <div className="col-sm-8 offset-sm-4">
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
              <tfoot>
              <tr>
                  <td>
                  <button onClick={submitCart}>place oder now</button>
                </td>
              </tr>
              </tfoot>
            
          </tbody>
        </Table>
      </div>
    </div>
  );
}

export default ProductList;














/// import React, { useState, useEffect } from 'react';
// import { Table } from 'react-bootstrap';
// import { Link, useNavigate } from 'react-router-dom';
// import {Cart } from './Cart'

// function ProductList() {
//   const [data, setData] = useState([]);
//   const navigate = useNavigate();

//   useEffect(() => {
//     fetchData();
//   }, []);

//   async function fetchData() {
//     try {
//       const response = await fetch('http://localhost:8000/api/listProduct',{
//       method: 'GET',
//       });
//       if (!response.ok) {
//         throw new Error('Failed to fetch data');
//       }
//       const result = await response.json();
//       setData(result);
//     } catch (error) {
//       console.error(error);
//     }
//   }

//   async function deleteOperation(id) {
//     try {
//       const response = await fetch(`http://localhost:8000/api/delete/${id}`, {
//         method: 'DELETE',
//       });

//       if (!response.ok) {
//         throw new Error('Failed to delete data');
//       }

//       const result = await response.json();
//       console.warn(result);

//       // Call fetchData() again to update the data after deletion
//       fetchData();
//     } catch (error) {
//       console.error(error);
//     }
//   }

//   async function addToCart(productId) {
//     try {
//       const response = await fetch('http://localhost:8000/cart/add', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ id: productId }),
//       });

//       if (!response.ok) {
//         throw new Error('Failed to add product to cart');
//       }

//       const data = await response.json();
//       console.log(data);
//       // Optionally, you can display a success message or perform additional actions
//     } catch (error) {
//       console.error(error);
//     }
//   }

//   async function submitCart() {
//     try {
//       const response = await fetch('http://localhost:8000/cart/submit', {
//         method: 'POST',
//       });

//       if (!response.ok) {
//         throw new Error('Failed to submit cart');
//       }

//       const data = await response.json();
//       console.log(data);
//       // Redirect the user to the checkout page
//       navigate('/checkout');
//     } catch (error) {
//       console.error(error);
//     }
//   }

//   return (
//     <div>
//       <h1>Product Listing page</h1>
//       <div className="col-sm-8 offset-sm-4">
//         <Table align="center" className="table">
//           <thead align="center" bgcolor="green">
//             <tr>
//               <th>Id</th>
//               <th>Name</th>
//               <th>Price</th>
//               <th>Brand</th>
//               <th>Description</th>
//               <th>Availability</th>
//               <th>Image</th>
//               <th>Operation</th>
//               <th>Cart</th>
//             </tr>
//           </thead>
//           <tbody>
//             {data.map((item) => (
//               <tr key={item.id}>
//                 <td>{item.id}</td>
//                 <td>{item.name}</td>
//                 <td bgcolor="cyan">KSH {item.price}</td>
//                 <td>{item.brand}</td>
//                 <td>{item.description}</td>
//                 <td>{item.availability}</td>
//                 <td style={{ width: 20 }}>
//                   <img src={`http://localhost:8000/${item.file_path}`} alt="Product" 
//                   onClick={() => addToCart(item.id)} style={{ cursor: 'pointer' }} />
//                 </td>
//                 <td>
//                   <span className="delete" onClick={() => deleteOperation(item.id)}>
//                     DELETE
//                   </span>
//                 </td>
//                 <td>
//                   <Link to={`updateProduct/${item.id}`}>
//                     <span className="update">UPDATE</span>
//                   </Link>
//                 </td>
//                 <td>
//                   <button onClick={submitCart}>Cart</button>
//                 </td>
//               </tr>
//             ))}
//           </tbody>
//         </Table>
//       </div>
//     </div>
//   );
// }

// export default ProductList;
