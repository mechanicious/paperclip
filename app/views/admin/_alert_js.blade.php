@section('error')
		<div style="display:none;" class="notification-puller-error"></div>
@stop

@section('success')
		<div style="display:none;" class="notification-puller-success"></div>
@stop

@section('warning')
		<div style="display:none;" class="notification-puller-warning"></div>
@stop

@section('info')
		<div style="display:none;" class="notification-puller-info"></div>
		<script defer="true">
			NotificationPuller = function() {
				if(! window.jQuery) return console.warn('Notification Puller: no jQuery detected, init failed.'),
					this.prototype = null;
				this.notificationTypes = ['Success', 'Warning', 'Error', 'Info'];
			};
			NotificationPuller.prototype.pull = function(url, callback) {
				jQuery.get(url, function(data, textStatus, xhr) {
					callback(data, textStatus, xhr);
				});
			}

			NotificationPuller.prototype.notificationDefaultTemplate = function(classn, message) {
				return '<div class="alert alert-'+ classn +' animated shake">'
									+ '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
									+ message
								+ '</div>';
			}

			NotificationPuller.prototype.pullWarning = function() {
				_this = this;
				this.pull('/api/secret/dashboard/notifications/warning', function(data) {
					$.each(JSON.parse(data), function(i, e) {
						if(_this.isMessage(e))
						 $('.notification-puller-warning').replaceWith(_this.notificationDefaultTemplate('warning', e));
					});
				});
			}

			NotificationPuller.prototype.pullError = function() {
				_this = this;
				this.pull('/api/secret/dashboard/notifications/error', function(data) {
					$.each(JSON.parse(data), function(i, e) {
						if(_this.isMessage(e))
						 $('.notification-puller-error').replaceWith(_this.notificationDefaultTemplate('danger', e));
					});
				});
			}

			NotificationPuller.prototype.pullInfo = function() {
				_this = this;
				this.pull('/api/secret/dashboard/notifications/info', function(data) {
					$.each(JSON.parse(data), function(i, e) {
						if(_this.isMessage(e))
						 $('.notification-puller-info').replaceWith(_this.notificationDefaultTemplate('info', e));
					});
				});
			}

			NotificationPuller.prototype.pullSuccess = function() {
				_this = this;
				this.pull('/api/secret/dashboard/notifications/success', function(data) {
					$.each(JSON.parse(data), function(i, e) {
						if(_this.isMessage(e))
						 $('.notification-puller-success').replaceWith(_this.notificationDefaultTemplate('success', e));
					});
				});
			}

			NotificationPuller.prototype.isMessage = function(e) {
				if(e.length > 0) return true;
				return false;
			}

			NotificationPuller.prototype.pullAll = function() {
				_this = this;
				$.each(this.notificationTypes, function(i, e) {
					_this['pull' + e]();
				});
			}

			document.addEventListener("DOMContentLoaded", function() {
				jQuery(document).ready(function($) {
					(new NotificationPuller()).pullAll();
				}); 
			});
		</script>
@stop