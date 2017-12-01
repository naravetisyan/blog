import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import EditCategoryModal from '../modals/EditCategoryModal';
import PropTypes from 'prop-types';

export default class EditCategories extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            category_name: '',
            data_target: '#'+this.props.id+'edit',
            old_name: ''
        }
        this.handleUpdate = this.handleUpdate.bind(this);
        this.getName = this.getName.bind(this);
    }
    getName(e){
        this.setState({ name: e.target.value });
        this.setState({ old_name: e.target.value });
    }
    handleUpdate(){
        axios.put('/api/me/categories/' + this.props.id,{'title':this.state.name}).then((response) => {
            this.props.editCategory(response.data.msg[0]);
        })
    }
    componentWillMount(){
        this.setState({old_name: this.props.old_name})
    }
    render() {
        return (
            <div className='cat-edit'>      
                <div className="editCategory" data-toggle="modal" data-target={this.state.data_target}>
                    <img className="edit-icon" src="edit.png"/>
                </div>
                <EditCategoryModal 
                    body_id={this.props.id} 
                    getName={this.getName} 
                    old_name={this.state.old_name}
                    name={this.state.name} 
                    handleUpdate={this.handleUpdate} 
                />
            </div>          
        );
    }
}