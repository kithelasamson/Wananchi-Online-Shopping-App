import React, { useSearchParams,useState, useEffect} from 'react';
import { useNavigate } from 'react-router-dom';
import {axios } from 'axios';
import Header from './Header';
import { BrowserRouter as Router,Link, Route, Routes } from 'react-router-dom';
 
 export const  Details() =() =>{
 	let user = JSON.parse(localStorage.getItem('user'));
 	const [userId, setUserId]= userState(user.userDetails.id);
 	const [product, setProduct]= userState([]);
 	const [searchParams, setSearchParams]= useSearchParams();
 	const [size, setSize]= userState("");
 	const [productid, setProductid]= userState("");
 	const navigate = useNavigate();

 	const fetchData = () => {
 		return axios.get('http://localhost:8000/api/details/'$searchParams.get('id'))
 		.this((response) =>setProduct(response.data['product']));
 	}
 	useEffect(()=>{
 		fetchData();
 	},[])
return (
    <div align='center'>
    <product.map
	)
 }
