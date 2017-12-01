import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import {Redirect} from "react-router";

export default class Login extends Component{
        constructor(props) { 
        super(props) 
        this.state = {
            email: '',
            password: '',
            user_id: null
        }
        this.handleChangeEmail = this.handleChangeEmail.bind(this);
        this.handleChangePass = this.handleChangePass.bind(this);
        this.submitForm = this.submitForm.bind(this);
    }
    handleChangeEmail(e) {
        this.setState({email: e.target.value});
    }
    handleChangePass(e) {
        this.setState({password: e.target.value});
    }
    submitForm(e) {
        e.preventDefault();
        const user = {
            email: this.state.email,
            password: this.state.password
        }
        const url = '/api/login';
        axios.post(url, user).then((response) => {
            sessionStorage.setItem('id', response.data.user.id);
            sessionStorage.setItem('name', response.data.user.name);
            this.setState({user_id: response.data.user.id});
        });
    }
    render() {
        let redirect
        if(this.state.user_id) {
            redirect = <Redirect to="/" />;
        }
        return (
            <div>
                <div className="container">
                    <div id="login-box">
                        <div className="logo">
                            <h1 className="logo-caption"><span className="tweak">L</span>ogin</h1>
                        </div>
                        <div className="controls">
                            <input type="text" name="email" placeholder="Email" value={this.state.email} onChange={this.handleChangeEmail} className="form-control" />
                            <input type="password" name="password" placeholder="Password" value={this.state.password} onChange={this.handleChangePass} className="form-control" />
                            <button type="submit" onClick={this.submitForm} className="btn btn-default btn-block btn-custom">Login {redirect} </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}