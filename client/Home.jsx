import axios from 'axios';
import { useEffect, useState } from 'react';
const Home = () => {
  const [url, setUrl] = useState(null);
  const handleLogin = async () => {
    const res = await axios.get('http://localhost:8000/api/login/google', {
      headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS',
      },
    });
    if (res.status === 200) {
      setUrl(res.data.url);
    }
  };
  useEffect(() => {
    handleLogin();
  }, []);

  return (
    <div className='App'>
      <a className='App-link' href={url}>
        Sign in with Google
      </a>
    </div>
  );
};

export default Home;
