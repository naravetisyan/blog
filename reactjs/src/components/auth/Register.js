import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

export default class Register extends Component{
    constructor(props) { 
        super(props) 
        this.state = {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
        this.handleChangeName = this.handleChangeName.bind(this);
        this.handleChangeEmail = this.handleChangeEmail.bind(this);
        this.handleChangePass = this.handleChangePass.bind(this);
        this.handleChangeConfirmPass = this.handleChangeConfirmPass.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleChangeName(e) {
        this.setState({
            name: e.target.value
        })
    }
    handleChangeEmail(e) {
        this.setState({
            email: e.target.value
        })
    }
    handleChangePass(e) {
        this.setState({
            password: e.target.value
        })
    }
    handleChangeConfirmPass(e) {
        this.setState({
            password_confirmation: e.target.value
        })
    }
    handleSubmit(e) {
        e.preventDefault();
        const user = {
            name: this.state.name,
            email: this.state.email,
            password: this.state.password,
            password_confirmation: this.state.password_confirmation
        }

        let uri = '/api/register';
        axios.post(uri, user);
        return false;
    }
    render() {
        return (
            <div className="container">
                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" value={this.state.name} onChange={this.handleChangeName} name="name" required/>

                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" value={this.state.email} onChange={this.handleChangeEmail} name="email" required/>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" value={this.state.password} onChange={this.handleChangePass} name="password" required/>

                <label><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" value={this.state.password_confirmation} onChange={this.handleChangeConfirmPass} name="password_confirmation" required/>
                <input type="checkbox"/> Remember me

                <div className="clearfix">
                    <button type="button" className="cancelbtn">Cancel</button>
                    <button type="submit" onClick={this.handleSubmit} className="signupbtn">Sign Up</button>
                </div>
            </div>    
        )
    }
}


