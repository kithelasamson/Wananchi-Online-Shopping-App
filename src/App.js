import React from 'react';
import './App.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import LoginPage from './LoginPage';
import Register from './Register';
import UpdateProduct from './UpdateProduct';
import Home from './Home';
import AddProduct from './AddProduct';
import Header from './Header';
import ProductList from './ProductList';
import SearchProduct from './SearchProduct';
import Checkout from './Checkout';

function App() {
  return (
    <div className="App">
      <Router>
        <Header />

        <h1>Wananchi App</h1>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/Header" element={<Header />} />
          <Route path="/ProductList" element={<ProductList />} />
          <Route path="/addProduct" element={<AddProduct />} />
          <Route path="/loginPage" element={<LoginPage />} />
          <Route path="/Search" element={<SearchProduct />} />
          <Route path="/register" element={<Register />} />
          <Route path="/updateProduct/:id" element={<UpdateProduct />} />
          <Route path="/products" element={<ProductList />} />
          <Route path ="/checkout" element ={<Checkout />} />
          <Route path="/updateProduct" element={<UpdateProduct />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
