import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import EditPostModal from '../modals/EditPostModal';
import PropTypes from 'prop-types';

export default class EditPost extends Component {
    constructor(props){
        super(props);
        this.state = {
            show_categories: [],
            my_categories: [],
            post_name: '',
            post_text: '',
            selected_cat:'',
            image: '',
            new_post: '',
            data_target: '#'+this.props.id+'edit_post',
        }
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
        this.setState({selected_cat: e.target.value});
    }
    get_post_image(e) {
        this.setState({image: e.target.files[0]});
    }
    submitForm(e) {
        e.preventDefault();
        let data = new FormData();
        data.append('title', this.state.post_name);
        data.append('text', this.state.post_text);
        data.append('category_id', this.state.selected_cat);
        data.append('image', this.state.image);
        data.append('id', this.props.id);
        data.append('_method', "PUT");
        
        axios.post('/api/edit_post/'+ this.props.id, data).then((response) => {
            this.setState({new_post: response.data.edited_post})
            this.props.editPost(response.data.edited_post); 
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
                <div className=' editPost' data-toggle="modal" data-target={this.state.data_target}>
                    <img className="edit_post_icon" src="edit.png"/>
                </div>
                <EditPostModal
                    post_name={this.state.post_name} 
                    selected_cat={this.state.selected_cat}
                    post_text={this.state.post_text} 
                    show_categories={this.state.show_categories}
                    get_post_name={this.get_post_name} 
                    get_post_image={this.get_post_image} 
                    get_post_text={this.get_post_text} 
                    changeSelect={this.changeSelect}
                    submitForm={this.submitForm}
                    body_id={this.props.id}
                />
            </div>          
        );
    }
}