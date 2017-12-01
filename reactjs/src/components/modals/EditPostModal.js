import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class EditPostModal extends Component {
    render() {
        return (
            <div>
                <div className="modal fade" id={this.props.body_id + 'edit-post' } tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog" role="document">
                        <div className="modal-content">
                            <div className="modal-body">
                                <label htmlFor="exampleInputEmail1">Edit Post</label>
                                <input type="text" className="form-control" id="exampleInputEmail1" placeholder="Enter Title"
                                value={this.props.post_name} onChange={this.props.getPostName}/>
                                <textarea placeholder="Post Text" value={this.props.post_text} onChange={this.props.getPostText}> </textarea><br/>
                                <select onChange={this.props.changeSelect} value={this.props.selected_cat}>
                                    <option>Select Category</option>
                                    {
                                        this.props.show_categories.map((val, index) => { 
                                            return (
                                                <option key={index} value={val.id}>{val.title}</option>
                                            );
                                        })    
                                    }
                                </select>
                                <input name='image'  type="file"  id='image' onChange={this.props.getPostImage} className="form-control" />
                            </div>
                            <div className="modal-footer">
                                <button onClick={this.props.submitForm} className="btn btn-primary add-something" data-dismiss="modal">Save</button>
                                <button className="btn btn-secondary add-something" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
