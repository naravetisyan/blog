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
            oldName: ''
        }
        this.handleUpdate = this.handleUpdate.bind(this);
        this.getName = this.getName.bind(this);
    }
    getName(e){
        this.setState({ name: e.target.value });
        this.setState({ oldName: e.target.value });
    }
    handleUpdate(){
        axios.put('/api/edit_category/' + this.props.id,{'title':this.state.name}).then((response) => {
            this.props.editCategory(response.data.msg[0]);
        })
    }
    componentWillMount(){
        this.setState({oldName: this.props.oldName})
    }
    render() {
        return (
            <div className='cat_edit'>      
                <div className="editCategory" data-toggle="modal" data-target={this.state.data_target}>
                    <img className="edit_icon" src="edit.png"/>
                </div>
                <EditCategoryModal 
                    body_id={this.props.id} 
                    getName={this.getName} 
                    oldName={this.state.oldName}
                    name={this.state.name} 
                    handleUpdate={this.handleUpdate} 
                />
            </div>          
        );
    }
}