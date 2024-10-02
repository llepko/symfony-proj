import React, {Component} from 'react';
import {Route, Routes, Navigate, Link, withRouter} from 'react-router-dom';
import Users from './Users';
class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"/"}> Symfony React Project </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/users"}> Users </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <Routes>
                    <Route path="/users" element={<Users/>} />
                </Routes>
            </div>
        )
    }
}

export default Home;