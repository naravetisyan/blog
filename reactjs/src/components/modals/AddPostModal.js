import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class AddPostModal extends Component {
    render() {
        return (
            <div>
                <div className="modal fade" id="add_post_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog" role="document">
                        <div className="modal-content">
                            <div className="modal-body">
                                <label htmlFor="exampleInputEmail1">Add Post</label>
                                <input type="text" className="form-control" id="exampleInputEmail1" placeholder="Post"
                                value={this.props.post_name} onChange={this.props.get_post_name} required/>
                                <textarea value={this.props.post_text} onChange={this.props.get_post_text}> </textarea>
                                <select onChange={this.props.changeSelect} value={this.props.selected_category}>
                                    <option></option>
                                    {
                                        this.props.show_categories.map((val, index) => { 
                                            return (
                                                <option key={index} value={val.id}>{val.title}</option>
                                            );
                                        })    
                                    }
                                </select>
                                <input name='image'  type="file"  id='image' onChange={this.props.get_post_image} className="form-control" />
                            </div>
                            <div className="modal-footer">
                                <button type="button" onClick={this.props.submitForm} className="btn btn-primary add_something" data-dismiss="modal">Save</button>
                                <button type="button" className="btn btn-secondary add_something" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        );
    }
}