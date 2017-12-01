import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import AddPostModal from '../modals/AddPostModal';
import PropTypes from 'prop-types';

export default class AddPost extends Component {
    constructor(props){
        super(props);
        this.state = {
            show_categories: [],
            my_categories: [],
            post_name: '',
            post_text: '',
            selected_category:'',
            image: '',
            new_post: []
        };
        this.getPostName = this.getPostName.bind(this);
        this.getPostText = this.getPostText.bind(this);
        this.getPostImage = this.getPostImage.bind(this);
        this.changeSelect = this.changeSelect.bind(this);
        this.submitForm = this.submitForm.bind(this);
    }
    getPostName(e) {
        this.setState({post_name: e.target.value});
    }
    getPostText(e) {
        this.setState({post_text: e.target.value});
    }
    changeSelect(e) {
        this.setState({selected_category: e.target.value});
    }
    getPostImage(e) {
        this.setState({image: e.target.files[0]});
    }
    submitForm(e) {
        e.preventDefault();
        let data = new FormData();
        data.append('title', this.state.post_name);
        data.append('text', this.state.post_text);
        data.append('category_id', this.state.selected_category);
        data.append('image', this.state.image);
        
        axios.post('/api/me/posts', data).then((response) => {
            this.setState({new_post: response.data.added_post})
            this.props.addPost(this.state.new_post);
        });
    }
    componentWillMount(){
        axios.get("/api/categories").then((response) => {
            this.setState({
                show_categories: response.data.categories
            })
        })
    }
    render() {
        return (
            <div className="for-position">
                <div className=' addPost' data-toggle="modal" data-target="#add-post-modal">
                    <button type="button" className="btn btn-success">Add post</button>
                </div>
                <AddPostModal
                    getPostImage={this.getPostImage}
                    show_categories={this.state.show_categories}
                    getPostName={this.getPostName} 
                    post_name={this.state.post_name}    
                    getPostText={this.getPostText} 
                    post_text={this.state.post_text} 
                    submitForm={this.submitForm}
                    changeSelect={this.changeSelect}
                    selected_category={this.state.selected_category}
                />
            </div>          
        );
    }
}