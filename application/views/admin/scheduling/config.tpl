{extends "../layout.tpl"}

{block "header"}
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="{site_url()}resources/bootstrap_css.css" rel="stylesheet" type="text/css">
{/block}

{block "content"}

<div class="section" ng-app="configApp" ng-controller="config_controller as config">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-2">
              <label for="inputName" class="control-label">Name</label>
            </div>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="Name" placeholder="Name" ng-model="config.name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2">
              <label for="inputPeriods" class="control-label">Periods</label>
            </div>
            <div class="col-sm-10">
            	<div class="form-group" ng-repeat="(key, period) in config.periods">
	              <div class="row">
	                <div class="row">
	                  <div class="col-sm-1">
	                    <a href ng-click="config.delete_period(key)"><i class="fa fa-2x fa-fw fa-trash"></i></a>
	                  </div>
	                  <div class="col-sm-11">
	                    <div class="col-sm-6">
	                      <input type="text" class="form-control" id="inputPeriods[start]" placeholder="0000-00-00" ng-model="period.start">
	                    </div>
	                    <div class="col-sm-6">
	                      <input type="text" class="form-control" id="inputPeriods[end]" placeholder="0000-00-00" ng-model="period.end">
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <div class="row row-top-spacing">
	                <div class="col-sm-12">
	                  <div class="form-group">
	                    <div class="col-sm-2">
	                      <label for="inputTimes" class="control-label">Times</label>
	                    </div>
	                    <div class="col-sm-10">
	                      <div class="form-group" ng-repeat="(index, time) in period.times">
	                        <div class="row">
	                          <div class="col-sm-1">
	                            <a href ng-click="config.delete_time(key, index)"><i class="fa fa-2x fa-fw fa-trash"></i></a>
	                          </div>
	                          <div class="col-sm-11">
	                            <input type="text" class="form-control" id="inputTimes" placeholder="00:00:00" ng-model="time.start">
	                          </div>
	                        </div>
	                        <div class="row">
	                          <div class="col-sm-offset-1 col-sm-11">
	                            <div class="checkbox">
	                              <label>
	                                <input type="checkbox" ng-model="time.su">SU</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.mo">MO</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.tu">TU</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.we">WE</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.th">TH</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.fr">FR</label>
	                              <label>
	                                <input type="checkbox" ng-model="time.sa">SA</label>
	                            </div>
	                          </div>
	                        </div>
	                      </div>
	                      <hr>
	                      <div class="row">
	                        <div class="col-sm-11">
	                          <input type="text" class="form-control" id="inputTimes" ng-model="config.addTimeVal[key]" placeholder="Time to play...">
	                        </div>
	                        <div class="col-sm-1">
	                          <a href ng-click="config.add_time(key)"><i class="fa fa-2x fa-fw fa-plus"></i></a>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <hr>
	            </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputPeriods[start]" placeholder="Start date... (YYYY-MM-DD)" ng-model="config.addPeriodStart">
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputPeriods[end]" placeholder="End date..." ng-model="config.addPeriodEnd">
                </div>
                <div class="col-sm-1">
                  <a href ng-click="config.add_period()"><i class="fa fa-2x fa-fw fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	angular.module('configApp', []).controller('config_controller', function(){
		this.name = "Blockname";
		this.periods = [];

		this.delete_period = function(period) {
			this.periods.splice(period,1);
		}
		this.delete_time = function(period, time) {
			this.periods[period].times.splice(time,1);
		}

		this.add_period = function() {
			this.periods.push({
				'start': this.addPeriodStart,
				'end': this.addPeriodEnd,
				'times': []
			});
			this.addPeriodStart = "";
			this.addPeriodEnd = "";
		}
		this.add_time = function(period) {
			this.periods[period].times.push({
				'start': this.addTimeVal[period],
				'su': true,
				'mo': false,
				'tu': false,
				'we': false,
				'th': true,
				'fr': false,
				'sa': false
			});
			this.addTimeVal = "";
		}
	})
</script>

{/block}