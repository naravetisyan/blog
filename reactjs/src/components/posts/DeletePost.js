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
        axios.delete('/api/me/posts/'+this.props.id).then((response) => {
            this.props.deletePost(response.data.deleted_posts_id);
        })
    }
    render() {
        return (
            <div className='post-delete'>     
                <div className='deletePost' data-toggle="modal" data-target={this.state.data_target}>
                    <img className="del-post-icon" src="delete.png"/>
                </div>                      
                <DeletePostModal deletePost={this.deletePost} body_id={this.props.id}/>
            </div>          
        );
    }
}