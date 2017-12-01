import React, { Component } from 'react';
import axios from 'axios';
import DeleteCategoryModal from '../modals/DeleteCategoryModal';
import PropTypes from 'prop-types';

export default class DeleteCategories extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            data_target: '#'+this.props.id+'delete'
        }
        this.deleteCategory = this.deleteCategory.bind(this);
    }
    deleteCategory(){
        axios.delete('/api/me/categories/'+this.props.id).then((response) => {
            this.props.deleteCategory(response.data.deleted_cats_id);
        })
    }
    render() {
        return (
            <div className='cat-delete'>     
                <div className='deleteCategory' data-toggle="modal" data-target={this.state.data_target}>
                    <img className="del-icon" src="delete.png"/>
                </div>                      
                <DeleteCategoryModal 
                    deleteCategory={this.deleteCategory} 
                    body_id={this.props.id}
                />
            </div>          
        );
    }
}