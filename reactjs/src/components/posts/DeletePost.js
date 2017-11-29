import React, { Component } from 'react';
import axios from 'axios';
import DeletePostModal from '../modals/DeletePostModal';
import PropTypes from 'prop-types';

export default class DeletePost extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            data_target: '#'+this.props.id+'delete'
        }
        this.deletePost = this.deletePost.bind(this);
    }
    deletePost(){
        axios.delete('/api/delete_post/'+this.props.id).then((response) => {
            this.props.deletePost(response.data.deleted_posts_id);
        })
    }
    render() {
        return (
            <div className='post_delete'>     
                <div className='deletePost' data-toggle="modal" data-target={this.state.data_target}>
                    <img className="del_post_icon" src="delete.png"/>
                </div>                      
                <DeletePostModal deletePost={this.deletePost} body_id={this.props.id}/>
            </div>          
        );
    }
}