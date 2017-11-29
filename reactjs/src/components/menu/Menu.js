import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

export default class Menu extends Component{
    render() {
        let my_categories
        let my_posts
        const id = sessionStorage.getItem('id')
        const name = sessionStorage.getItem('name') 
        let logout = () => {
            sessionStorage.clear();
            axios.get("/api/logout");
        }
        let Links 
        if(sessionStorage.getItem('id')) {
            my_categories = (
                <Link to="/me/categories">My Categories</Link>
            )
            my_posts = (
                <Link to="/me/posts">My Posts</Link>
            )
        }
        if(!name) { 
            Links = () => (
                <ul className="nav navbar-nav navbar-right">
                    <li>
                        <Link to="/login">Login</Link>
                    </li>
                    <li>
                        <Link to="/register">Register</Link>
                    </li>
                </ul>
            );
        } else {
            Links = () => (
                <ul className="nav navbar-nav navbar-right">
                    <li className="dropdown">
                        <button className="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            {name} <span className="caret"></span>
                        </button> 
                        <ul className="dropdown-menu">
                            <li><Link to="/login" onClick={logout} >Logout</Link></li>
                            <li>{my_categories}</li>
                            <li>{my_posts}</li>
                        </ul>
                    </li>
                </ul>
            )
        }
        let logged_in_user = <Links/>
        return (
            <div className="Menu">
                <nav className="navbar navbar-default navbar-static-top">
                    <div className="container">
                        <div className="navbar-header">
                            <Link to="/" className="navbar-brand">React</Link>
                        </div> 
                        <div id="app-navbar-collapse" className="collapse navbar-collapse">
                            <ul className="nav navbar-nav">&nbsp;</ul>
                            {logged_in_user}
                        </div>
                    </div>
                </nav>
            </div>
        )
    }
}