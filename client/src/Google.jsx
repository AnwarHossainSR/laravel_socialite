import axios from 'axios';
import React, { useEffect } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';

const Google = () => {
  const { search } = useLocation();
  const navigate = useNavigate();

  const getUser = async () => {
    const res = await axios.get(
      `http://localhost:8000/api/google/callback${search}`,

      {
        headers: {
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS',

          'Access-Control-Allow-Headers': 'Content-Type, Authorization',
        },
      }
    );
    if (res.data.token) {
      localStorage.setItem('token', res.data.token);
      navigate('/dashboard');
    }
  };

  useEffect(() => {
    getUser();
  }, [search]);

  return <div>Google</div>;
};

export default Google;
