import React, { useState, useEffect } from 'react';
import { Navbar, Nav, NavDropdown } from 'react-bootstrap';
import { Link, useNavigate } from 'react-router-dom';
import { MdShoppingCart } from 'react-icons/md';
import { useStateValue } from './StateProvider';
import './header.css';

function Header() {
  const [userName, setUserName] = useState('');
  const [{ basket }] = useStateValue();
  const navigate = useNavigate();

  useEffect(() => {
    let user = JSON.parse(localStorage.getItem('user-info'));
    if (user) {
      setUserName(user.name);
    }
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('user-info');
    navigate('/loginPage');
    setUserName('');
  };

  const handleProfileClick = () => {
    if (localStorage.getItem('user-info')) {
      alert(`User Info: ${JSON.stringify(localStorage.getItem('user-info'))}`);
    }
  };

  const isLoggedIn = localStorage.getItem('user-info');

  return (
    <div className="header">
      <Navbar bg="dark" variant="dark" className="navbar">
        <Navbar.Brand>WANANCHI APP</Navbar.Brand>
        <Nav className="header-links ml-auto">
          {isLoggedIn ? (
            <>
              <Nav.Link as={Link} to="/home">
                Home
              </Nav.Link>
              <Nav.Link as={Link} to="/Search">
                Search Product
              </Nav.Link>
              <Nav.Link as={Link} to="/addProduct">
                Add Product Page
              </Nav.Link>
              <Nav.Link as={Link} to="/updateProduct/:id">
                Update Product
              </Nav.Link>
              <Nav.Link as={Link} to="/ProductList">
                ProductList Page
              </Nav.Link>
              <Nav.Link as={Link} to="/Checkout" className="header_link">
                <div className="header_optionBasket">
                  <span className="header_optionBasket_title gone">Cart</span>
                  <MdShoppingCart className="cart_img" />
                  <span className="header_optionLineTwo header_basketCount">
                    {basket?.length}
                  </span>
                </div>
              </Nav.Link>
              <NavDropdown title={userName}>
                <NavDropdown.Item onClick={handleLogout}>Logout</NavDropdown.Item>
                <NavDropdown.Item onClick={handleProfileClick}>Profile</NavDropdown.Item>
              </NavDropdown>
            </>
          ) : (
            <>
              <Nav.Link as={Link} to="/loginPage">
                Login Page
              </Nav.Link>
              <Nav.Link as={Link} to="/register">
                Register Page
              </Nav.Link>
            </>
          )}
        </Nav>
      </Navbar>
    </div>
  );
}

export default Header;
