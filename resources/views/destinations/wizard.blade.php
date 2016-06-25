@extends('layouts.app')
@section('page-title','Create Experience')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<style type="text/css">
			#installationForm .tab-content {
				margin-top: 20px;
			}
			</style>

			<form id="installationForm" class="form-horizontal">
				<ul class="nav nav-pills">
					<li class="active"><a href="#basic-tab" data-toggle="tab">Bacis</a></li>
					<li><a href="#database-tab" data-toggle="tab">Images</a></li>
				</ul>

				<div class="tab-content">
					<!-- First tab -->
					<div class="tab-pane active" id="basic-tab">
						<div class="form-group">
							<label class="col-xs-3 control-label">Site name</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="name" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">URL</label>
							<div class="col-xs-7">
								<input type="text" class="form-control" name="url" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Owner email</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="email" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Description</label>
							<div class="col-xs-7">
								<textarea class="form-control" name="description" rows="6"></textarea>
							</div>
						</div>
					</div>

					<!-- Second tab -->
					<div class="tab-pane" id="database-tab">
						<div class="form-group">
							<label class="col-xs-3 control-label">Server IP</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="dbServer" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Database name</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="dbName" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Database user</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="dbUser" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Password</label>
							<div class="col-xs-5">
								<input type="password" class="form-control" name="dbPassword" />
							</div>
						</div>
					</div>

					<!-- Previous/Next buttons -->
					<ul class="pager wizard">
						<li class="previous"><a href="javascript: void(0);">Previous</a></li>
						<li class="next"><a href="javascript: void(0);">Next</a></li>
					</ul>
				</div>
			</form>

			<div class="modal fade" id="completeModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Complete</h4>
						</div>

						<div class="modal-body">
							<p class="text-center">The installation is completed</p>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Visit the website</button>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection

@section('app-js')
<script>
$(document).ready(function() {
    // You don't need to care about this function
    // It is for the specific demo
    function adjustIframeHeight() {
    	var $body   = $('body'),
    	$iframe = $body.data('iframe.fv');
    	if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    $('#installationForm')
    .formValidation({
    	framework: 'bootstrap',
    	icon: {
    		valid: 'glyphicon glyphicon-ok',
    		invalid: 'glyphicon glyphicon-remove',
    		validating: 'glyphicon glyphicon-refresh'
    	},
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
            	name: {
            		validators: {
            			notEmpty: {
            				message: 'The site name is required'
            			}
            		}
            	},
            	url: {
            		validators: {
            			notEmpty: {
            				message: 'The URL is required'
            			},
            			uri: {
            				message: 'The URL is not valid'
            			}
            		}
            	},
            	email: {
            		validators: {
            			notEmpty: {
            				message: 'The email address is required'
            			},
            			emailAddress: {
            				message: 'The email address is not valid'
            			}
            		}
            	},
            	dbServer: {
            		validators: {
            			notEmpty: {
            				message: 'The server IP is required'
            			},
            			ip: {
            				message: 'The server IP is not valid'
            			}
            		}
            	},
            	dbName: {
            		validators: {
            			notEmpty: {
            				message: 'The database name is required'
            			}
            		}
            	},
            	dbUser: {
            		validators: {
            			notEmpty: {
            				message: 'The database user is required'
            			}
            		}
            	}
            }
        })
.bootstrapWizard({
	tabClass: 'nav nav-pills',
	onTabClick: function(tab, navigation, index) {
		return validateTab(index);
	},
	onNext: function(tab, navigation, index) {
		var numTabs    = $('#installationForm').find('.tab-pane').length,
		isValidTab = validateTab(index - 1);
		if (!isValidTab) {
			return false;
		}

		if (index === numTabs) {
                    // We are at the last tab

                    // Uncomment the following line to submit the form using the defaultSubmit() method
                    // $('#installationForm').formValidation('defaultSubmit');

                    // For testing purpose
                    $('#completeModal').modal();
                }

                return true;
            },
            onPrevious: function(tab, navigation, index) {
            	return validateTab(index + 1);
            },
            onTabShow: function(tab, navigation, index) {
                // Update the label of Next button when we are at the last tab
                var numTabs = $('#installationForm').find('.tab-pane').length;
                $('#installationForm')
                .find('.next')
                        .removeClass('disabled')    // Enable the Next button
                        .find('a')
                        .html(index === numTabs - 1 ? 'Install' : 'Next');

                // You don't need to care about it
                // It is for the specific demo
                adjustIframeHeight();
            }
        });

function validateTab(index) {
        var fv   = $('#installationForm').data('formValidation'), // FormValidation instance
            // The current tab
            $tab = $('#installationForm').find('.tab-pane').eq(index);

        // Validate the container
        fv.validateContainer($tab);

        var isValidStep = fv.isValidContainer($tab);
        if (isValidStep === false || isValidStep === null) {
            // Do not jump to the target tab
            return false;
        }

        return true;
    }
});
</script>
@endsection



