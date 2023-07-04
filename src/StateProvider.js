
import React, { createContext, useContext, useReducer } from "react";

// Create the context for the global state
export const StateContext = createContext();

// Create the provider component
export const StateProvider = ({ reducer, initialState, children }) => (
  <StateContext.Provider value={useReducer(reducer, initialState)}>
    {children}
  </StateContext.Provider>
);

// Custom hook to access the state
export const useStateValue = () => useContext(StateContext);
