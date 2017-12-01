import React, { Component } from 'react';
import { Route } from 'react-router-dom';
import logo from './logo.svg';
import './App.css';
import Menu from './components/menu/Menu';
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Categories from './components/categories/Categories';
import Posts from './components/posts/Posts';
import MyPosts from './components/posts/MyPosts';
import MyCategories from './components/categories/MyCategories';
import { Button, ButtonToolbar } from 'react-bootstrap';
import { Link, Redirect } from 'react-router-dom';

export default class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            name: '',
            category: '',
            categories: [],
            user_id: ''
        }
        this.addCategory = this.addCategory.bind(this);
        this.editCategory = this.editCategory.bind(this);
        this.deleteCategory = this.deleteCategory.bind(this);
        this.addPost = this.addPost.bind(this);
        this.editPost = this.editPost.bind(this);
        this.deletePost = this.deletePost.bind(this);
    }
    addCategory(added_category){
        this.setState({added_category});
    }
 
    editCategory(edited_category){
        this.setState({edited_category});
    }
    deleteCategory(deleted_category){
        this.setState({deleted_category});
    }
    addPost(added_post){
    this.setState({ added_post});
    }
 
    editPost(edited_post){
        this.setState({edited_post});
    }
    deletePost(deleted_post){
        this.setState({deleted_post});
    }
    render() {
        let categories
        let login
        if(sessionStorage.getItem('id')) {
            categories = (
                <Categories 
                    added_category= {this.state.added_category} 
                    deleted_category={this.state.deleted_category} 
                    edited_category={this.state.edited_category}
                >
                </Categories>
            )
        }
        login = <Route exact path="/login"  render={() => {
                    return sessionStorage.getItem('id') ?
                    <Redirect to='/' />: <Login/>; 
                    } 
                }/>
        return (
            <div>
                <Menu />
                {categories}
                <div>
                    {login}
                    <Route exact path='/register' render={ () => <Register/> }/>
                    <Route exact path='/me/categories' render={ () => <MyCategories
                                                        addCategory={this.addCategory} 
                                                        editCategory={this.editCategory} 
                                                        deleteCategory={this.deleteCategory} 
                                                        /> 
                                                    }/>
                    <Route exact path="/"  render={() => <Posts 
                                                        deleted_post={this.state.deleted_post} 
                                                        added_post= {this.state.added_post} 
                                                        edited_post={this.state.edited_post}
                                                        /> 
                                                    }/>
                    <Route exact path='/me/posts' render={ () => <MyPosts
                                                        user_id={this.state.user_id}
                                                        addPost={this.addPost} 
                                                        editPost={this.editPost} 
                                                        deletePost={this.deletePost} 
                                                        /> 
                                                    }/>
                </div>
            </div>
        );
    } 
}
