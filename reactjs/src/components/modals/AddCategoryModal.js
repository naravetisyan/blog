import React, { Component } from 'react';
import PropTypes from 'prop-types';

export default class AddCategoryModal extends Component {
    render() {
        return (
            <div>
                <div className="modal fade" id="add_cat_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog" role="document">
                        <div className="modal-content">
                            <div className="modal-body">
                                <label htmlFor="exampleInputEmail1">Add Category</label>
                                <input type="text" className="form-control" id="exampleInputEmail1" placeholder="Category"
                                value={this.props.cat_name} onChange={this.props.get_cat_name}/>
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