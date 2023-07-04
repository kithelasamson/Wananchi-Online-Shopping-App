import Header from './Header';
import { useNavigate } from 'react-router-dom';
import React, { useState, useEffect } from 'react';
import { Dropdown } from 'react-bootstrap';


function AddProduct() {
  const [name, setName] = useState("");
  const [price, setPrice] = useState("");
  const [file, setFile] = useState("");
  const [brand, setBrand] = useState("");
  const [description, setDescription] = useState("");
  const [availability, setAvailability] = useState("");

  async function addProduct() {
    console.warn(file, name, price, brand, description, availability);
    const formData = new FormData();
    formData.append("name", name);
    formData.append("price", price);
    formData.append("brand", brand);
    formData.append("description", description);
    formData.append("file", file);
    formData.append("availability",availability);
    let result = await fetch('http://localhost:8000/api/addProduct',{
      method:'POST',
      body: formData
      });
    alert("Product added successfully");
  }


  return (
    <div className="col-sm-3 offset-sm-3">
      <h1>Add Product page</h1>
      <input type="file" className="form-control" onChange={(e) => setFile(e.target.files[0])} placeholder="file" /> <br />
      <input type="text" className="form-control" onChange={(e) => setName(e.target.value)} placeholder="Product name" /> <br />
      <input type="text" className="form-control" onChange={(e) => setPrice(e.target.value)} placeholder="Price" /> <br />
      <input type="text" className="form-control" onChange={(e) => setBrand(e.target.value)} placeholder="Brand" /> <br />
      <input type="text" className="form-control" onChange={(e) => setDescription(e.target.value)} placeholder="Description" /> <br />
      <input type="checkbox" className="form-control" onChange={(e) => setAvailability(e.target.checked)} 
      placeholder="Availability" /> <br />
      <button onClick={addProduct} className="btn btn-primary">Add Product</button>
      <Dropdown>
        <Dropdown.Toggle variant="primary" id="dropdown-basic">
           {/* Dropdown Icon */}
        </Dropdown.Toggle>

        <Dropdown.Menu>
          <Dropdown.Item href="#logout">Logout</Dropdown.Item>
          <Dropdown.Item href="#profile">Profile</Dropdown.Item>
        </Dropdown.Menu>
      </Dropdown>
    </div>
  );
}

export default AddProduct;
