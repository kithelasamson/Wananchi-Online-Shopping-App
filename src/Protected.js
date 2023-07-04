import React from 'react';
import { Route, Navigate } from 'react-router-dom';

function Protected({ Cmp }) {
  const isAuthenticated = localStorage.getItem('user-info');

  return isAuthenticated ? <Cmp /> : <Navigate to="/loginPage" />;
}

export default Protected;
