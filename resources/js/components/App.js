import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

// bootstrap css
import 'bootstrap/dist/css/bootstrap.min.css';

// import components
import SignIn from './SignIn';
import SignUp from './SignUp';
import Home from './Home';
import WithOutlet from './WithOutlet';

function App() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <Routes>
                    <Route path='/'>
                        <Route index element={<SignIn />} />
                        <Route path='sign-up' element={<SignUp />} />
                        <Route path='E-learning' element={<WithOutlet />}>
                            <Route index element={<Home />} />
                        </Route>
                    </Route>
                </Routes>
            </div>
        </div>
    );
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(
        <BrowserRouter>
            <App />
        </BrowserRouter>,
        document.getElementById('app')
    );
}