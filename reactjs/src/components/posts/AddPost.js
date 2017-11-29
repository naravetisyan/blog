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
        this.get_post_name = this.get_post_name.bind(this);
        this.get_post_text = this.get_post_text.bind(this);
        this.get_post_image = this.get_post_image.bind(this);
        this.changeSelect = this.changeSelect.bind(this);
        this.submitForm = this.submitForm.bind(this);
    }
    get_post_name(e) {
        this.setState({post_name: e.target.value});
    }
    get_post_text(e) {
        this.setState({post_text: e.target.value});
    }
    changeSelect(e) {
        this.setState({selected_category: e.target.value});
    }
    get_post_image(e) {
        this.setState({image: e.target.files[0]});
    }
    submitForm(e) {
        e.preventDefault();
        let data = new FormData();
        data.append('post_title', this.state.post_name);
        data.append('text', this.state.post_text);
        data.append('cat_name', this.state.selected_category);
        data.append('image', this.state.image);
        
        axios.post('/api/add_post', data).then((response) => {
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
            <div className="for_position">
                <div className=' addPost' data-toggle="modal" data-target="#add_post_modal">
                    <button type="button" className="btn btn-success">Add post</button>
                </div>
                <AddPostModal
                    get_post_image={this.get_post_image}
                    show_categories={this.state.show_categories}
                    get_post_name={this.get_post_name} 
                    post_name={this.state.post_name}    
                    get_post_text={this.get_post_text} 
                    post_text={this.state.post_text} 
                    submitForm={this.submitForm}
                    changeSelect={this.changeSelect}
                    selected_category={this.state.selected_category}
                />
            </div>          
        );
    }
}