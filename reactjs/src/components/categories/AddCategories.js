import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import AddCategoryModal from '../modals/AddCategoryModal';
import PropTypes from 'prop-types';

export default class AddCategories extends Component {
    constructor(props){
        super(props);
        this.state = {
            my_categories: [],
            cat_name: '',
            new_cat: ''
        };
        this.get_cat_name = this.get_cat_name.bind(this);
        this.submitForm = this.submitForm.bind(this);
    }
    get_cat_name(e) {
        this.setState({cat_name: e.target.value});
    }
    submitForm(e) {
        e.preventDefault();
        axios.post('/api/add_category', { title: this.state.cat_name }).then((response) => {
            this.setState({new_cat: response.data.added_category})
            this.props.addCategory(this.state.new_cat);
        });
    }
    render() {
        return (
            <div>
                <div>
                    <div className=' addCategory' data-toggle="modal" data-target="#add_cat_modal">
                        <button type="button" className="btn btn-success">Add Category</button>
                    </div>
                </div>    
                <AddCategoryModal
                    get_cat_name={this.get_cat_name} 
                    cat_name={this.state.cat_name} 
                    submitForm={this.submitForm}
                />
            </div>          
        );
    }
}