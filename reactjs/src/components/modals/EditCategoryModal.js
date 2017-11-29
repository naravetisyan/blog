
import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class EditCategoryModal extends Component {
    render() {
        return (
            <div id={this.props.body_id+'edit'} className="modal fade" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">Update Category</h4>
                        </div>
                        <div className="modal-body" id={this.props.body_id}>   
                            <input type="text"  value={this.props.oldName} onChange={this.props.getName} id="title" name="title" />
                            <input type="submit" onClick={this.props.handleUpdate} value="Update" id="edit_click" data-dismiss="modal" />
                            <button type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>        
        );
    }
}
