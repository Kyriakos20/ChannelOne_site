</div><!-- c-wrap -->

<!-- Source Modal -->

<div id="sourceModal" class="modal fade" role="dialog" ng-controller="SourceModalController as srcCntrl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select a Source</h4>
            </div>
            <div class="modal-body">
                <p>Select the source of this lead to proceed.</p>
                <p>
                    <select class="form-control" ng-model="srcCntrl.source" ng-options="src as src for src in srcCntrl.sources"></select>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" ng-click="srcCntrl.proceed()">Proceed</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Closed Modal -->

<div id="closedModal" class="modal fade" role="dialog" ng-controller="ClosedModalController as clsCntrl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Loan Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Closing Date</label>
                            <datepicker date-format="M/d/yyyy" date-typer="true">
                                <input class="form-control" ng-model="clsCntrl.closed.mortgage.date" placeholder="9/4/1975" type="text" />
                            </datepicker>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Loan Amount (UPB)</label>
                            <input class="form-control" ng-model="clsCntrl.closed.mortgage.amount" placeholder="100500" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control" ng-model="clsCntrl.closed.mortgage.rate" placeholder="5.5" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Rate Type</label>
                            <select class="form-control" ng-model="clsCntrl.closed.mortgage.rateType" ng-options="rateType as rateType for rateType in ['Fixed','Adjustable']"></select>
                        </div>
                        <div class="form-group">
                            <label>Previous Value</label>
                            <input class="form-control" ng-model="clsCntrl.closed.mortgage.previousValue" placeholder="100500" type="text" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Index</label>
                                    <input class="form-control" ng-model="clsCntrl.closed.mortgage.indexNum" placeholder="2.5" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Index Type</label>
                                    <select class="form-control" ng-model="clsCntrl.closed.mortgage.indexType" ng-options="iType as iType for iType in clsCntrl.iTypes"></select>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>MIP</label>
                                    <input class="form-control" ng-model="clsCntrl.closed.mortgage.mip" placeholder="0000" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Margin</label>
                                    <input class="form-control" ng-model="clsCntrl.closed.mortgage.margin" placeholder="0000" type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Principal Limit</label>
                            <input class="form-control" ng-model="clsCntrl.closed.mortgage.principalLimit" placeholder="0000" type="text" />    
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>1st Year Draw</label>
                                    <input class="form-control" ng-model="clsCntrl.closed.mortgage.draw" placeholder="0000" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>2nd Year Money</label>
                                    <input class="form-control" ng-model="clsCntrl.closed.mortgage.yeartwomoney" placeholder="0000" type="text" />
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <input class="statusBox" type="checkbox" ng-model="clsCntrl.closed.mortgage.lesa" value="lesa"> LESA
                        </div>

                        
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" ng-click="clsCntrl.proceed()">Proceed</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- detail modal -->

<div id="detail-modal" ng-controller="DetailModalController as dCnt">
    <div id="detail-modal-mask">

    </div>
    <div id="detail-modal-paper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="detail-title">
                        {{dCnt.lead.owner.primary.name.first}} <span ng-show="dCnt.lead.owner.primary.name.middle">{{dCnt.lead.owner.primary.name.middle+' '}}</span>{{dCnt.lead.owner.primary.name.last}}
                    </h1>
                    <h2 id="detail-address">
                        {{dCnt.lead.address.street1}}<span ng-show="dCnt.lead.address.street2">{{' '+dCnt.lead.address.street2}}</span>, {{dCnt.lead.address.city}}
                        <span ng-show="dCnt.lead.address.city">, </span>{{dCnt.lead.address.state}} {{dCnt.lead.address.zip}}
                    </h2>
                </div>
            </div>
            <div id="detail-modal-scroller">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <span class="label label-primary">System ID</span> {{dCnt.lead._id}}<br />
                                    <span class="label label-danger">Unique Lead ID</span> {{dCnt.lead.oldId}}<br />
                                    <span ng-show="dCnt.lead.isFirstTime" class="label label-success">1st Time</span>
                                    <span ng-show="!dCnt.lead.isFirstTime" class="label label-info">HECM to HECM</span>
                                    <h3 class="detail-section-title">
                                <span class="label label-primary">
                                    Borrowers
                                </span>
                                    </h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-uppercase text-primary">Borrower</div>
                                            <h4 class="low-padding">{{dCnt.lead.owner.primary.name | formatBorrower}}</h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-uppercase text-primary">Co-Borrower</div>
                                            <h4 class="low-padding">{{dCnt.lead.owner.secondary.name | formatBorrower}}</h4>
                                        </div>
                                    </div>
                                    <div ng-if="dCnt.isAdmin || dCnt.isOwner || dCnt.isLead">
                                        <h3 class="detail-section-title">
                                <span class="label label-primary">
                                    Current Mortgage
                                </span>
                                        </h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Amount</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgage.amount | currency:'$'}}</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Date</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgage.date | formatDate}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Rate</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgage.rate}}% {{dCnt.lead.mortgage.rateType}}</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Previous Value</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgage.previousValue | currency:'$'}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Lender</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgage.lender}}</h4>
                                            </div>
                                        </div>
                                        <h3 class="detail-section-title">
                                <span class="label label-primary">
                                    Value Estimate
                                </span>
                                        </h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Value</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgageValue.value | currency:'$'}}</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Date</div>
                                                <h4 class="low-padding">{{dCnt.lead.mortgageValue.date | formatDate}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Source</div>
                                                <h4 class="low-padding">
                                                    <a target="_blank" class="btn btn-xs btn-info" href="{{dCnt.lead.mortgageValue.link}}">{{dCnt.lead.mortgageValue.source}} <i class="fa fa-arrow-circle-right"></i></a><br />
                                                    <!--<a target="_blank" class="btn btn-xs btn-info" href="#">Redfin <i class="fa fa-arrow-circle-right"></i></a><br />-->
                                                    <a target="_blank" class="btn btn-xs btn-info" href="{{dCnt.homesnapLink(dCnt.lead)}}">Homesnap <i class="fa fa-arrow-circle-right"></i></a><br />
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-uppercase text-primary">Equity</div>
                                                <h4 class="low-padding">{{dCnt.lead.currentEquity | currency:'$'}} ({{dCnt.lead.currentEquityPercent | number:2}}%)</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <h3 class="detail-section-title"><span class="label label-primary">Phones</span>
                                        <button class="btn btn-xs btn-primary" ng-click="dCnt.showAddPhoneForm = true">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <a ng-href="{{dCnt.lead | piplLink}}" class="btn btn-xs btn-warning" target="_blank">pipl</a>
                                        <button class="btn btn-info btn-xs" ng-click="dCnt.getWP()">WP</button>
                                    </h3>
                                    <form ng-show="dCnt.showAddPhoneForm" ng-submit="dCnt.savePhone()" class="form-inline">
                                        <input type="text" class="form-control" ng-model="dCnt.newPhone">
                                        <button type="button" ng-click="dCnt.clearPhoneForm()" class="btn btn-sm btn-warning">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </form>
                                    <div ng-show="dCnt.wpResults" class="well well-sm">
                                        <h4>WP Results</h4>
                                        <div class="list-group">
                                            <div class="list-group-item" ng-repeat="entity in dCnt.wpResults.current_residents">
                                                <div class="text-primary" style="font-weight:bold">Name(s)</div>
                                                <div>
                                                    <i class="fa fa-arrow-circle-o-right"></i> {{ entity.name  }}
                                                </div>
                                                <div ng-show="entity.age_range" class="text-primary" style="font-weight:bold">
                                                    Age: {{entity.age_range}}
                                                </div>
                                                <div ng-show="entity.gender" class="text-primary" style="font-weight:bold">
                                                    Gender: {{entity.gender}}
                                                </div>
                                                <div class="text-primary" style="font-weight:bold">Phone(s)</div>
                                                <div ng-repeat="wpPhone in entity.phones">
                                                    <button ng-click="dCnt.saveWPPhone(wpPhone)" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button> {{wpPhone.phone_number}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <div class="list-group-item" ng-repeat="phone in dCnt.lead.phones | orderBy:['-status','-updated', '-createdAt']">
                                            <button class="btn badge" ng-class="(phone.status == 'Good')?'btn-success':'btn-danger'" ng-click="dCnt.updatePhoneStatus(phone)">
                                                <i ng-show="phone.status == 'Good'" class="fa fa-thumbs-up"></i>
                                                <i ng-show="phone.status == 'Bad'" class="fa fa-thumbs-down"></i>
                                            </button>

                                            <h4 class="list-group-item-heading">
                                                <a style="cursor:pointer" ng-click="dCnt.showDialModal()">
                                                    {{phone.number}}
                                                    <span ng-if="phone.phoneType == 'Mobile'"> <i class="fa fa-mobile-phone"></i></span>
                                                </a>
                                            </h4>
                                            <small>{{phone.createdAt | formatDate}} - {{phone.source}}</small> <small ng-if="phone.updated">- updated {{phone.updated | formatDate}} by {{phone.userName}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-normal panel-primary" ng-if="dCnt.mapSrc && dCnt.weather">
                            <div class="panel-body">
                                <div ng-if="dCnt.weather">

                                    <label class="label label-primary">Current Weather</label>
                                    <strong>{{dCnt.weather.main.temp}}&deg;F</strong>
                                    <img ng-src="{{dCnt.weatherIconURL + dCnt.weather.weather[0].icon + '.png'}}">
                                    <strong>{{dCnt.weather.weather[0].main}}</strong>

                                </div>
                                <iframe ng-if="dCnt.mapSrc"
                                        class="mapFrame"
                                        frameborder="0"
                                        allowfullscreen
                                        ng-src="{{dCnt.mapSrc}}"
                                >

                                </iframe>
                            </div>
                        </div>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <h3 class="detail-section-title">
                                <span class="label label-primary">
                                    Lead
                                </span>
                                </h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-uppercase text-primary">Can Call</div>
                                        <h4 class="low-padding">
                                            <button class="btn btn-xs" ng-class="(dCnt.lead.canCall=='No'?'btn-danger':'btn-success')" ng-click="dCnt.toggleDNC()">
                                                {{dCnt.lead.canCall}}
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-uppercase text-primary">Can Mail</div>
                                        <h4 class="low-padding">
                                            <button class="btn btn-xs" ng-class="(dCnt.lead.canMail=='No'?'btn-danger':'btn-success')" ng-click="dCnt.toggleDNM()">
                                                {{dCnt.lead.canMail}}
                                            </button>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-uppercase text-primary">Status</div>
                                        <h4 class="low-padding">{{dCnt.lead.status}}</h4>
                                        <p><small>{{dCnt.lead.statuses[dCnt.lead.statuses.length - 1].date | formatDateTime}}</small></p>
                                        <div ng-if="dCnt.lead.status != 'Lead'">
                                            <div ng-if="dCnt.canChangeStatus">
                                                <form ng-submit="dCnt.changeStatus()">
                                                    <select class="form-control" ng-model="dCnt.newStatus"
                                                            ng-options="status as status for status in dCnt.statuses"></select>
                                                    <br />
                                                    <button class="btn btn-xs btn-info" type="submit">Process <i class="fa fa-arrow-circle-right"></i></button>
                                                </form>
                                                <br />
                                                <button ng-click="dCnt.docsOut()" class="btn btn-warning btn-xs" type="button">Doc Out Form <i class="fa fa-pencil"></i></button>
                                            </div>
                                        </div>
                                        <div ng-if="dCnt.lead.bucket == 'Leads'">
                                            <button class="btn btn-xs btn-success" ng-click="dCnt.claimLead()">To Leads <i class="fa fa-tags"></i></button>
                                            <button class="btn btn-xs btn-success" ng-click="dCnt.claim()">To Pipeline <i class="fa fa-road"></i></button>
                                            <button class="btn btn-xs btn-success" ng-click="dCnt.takeApp()">Take App <i class="fa fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-uppercase text-primary">Working LO</div>
                                        <h4 class="low-padding">{{dCnt.lead.pipelineOwner.name | formatBorrower}}</h4>
                                        <p>&nbsp;</p>
                                        <div ng-if="dCnt.canChangeOwner">
                                            <form ng-submit="dCnt.changeOwner()">
                                                <select class="form-control" ng-model="dCnt.newOwner"
                                                        ng-options="user as user.name.last+', '+user.name.first for user in dCnt.users"></select>
                                                <br />
                                                <button class="btn btn-xs btn-info" type="submit">Process <i class="fa fa-arrow-circle-right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div ng-if="dCnt.canChangeStatus || dCnt.isLead">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-uppercase text-danger">TUD</div>
                                            <form ng-submit="dCnt.tud()">
                                                <select class="form-control" ng-model="dCnt.newTud"
                                                        ng-options="tud as tud for tud in dCnt.tuds"></select>
                                                <br />
                                                <button class="btn btn-xs btn-danger" type="submit">TUD <i class="fa fa-arrow-circle-right"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-uppercase text-danger">WTD</div>
                                            <form ng-submit="dCnt.wtd()">
                                                <select class="form-control" ng-model="dCnt.newWtd"
                                                        ng-options="wtd as wtd for wtd in dCnt.wtds"></select>
                                                <br />
                                                <button class="btn btn-xs btn-danger" type="submit">WTD <i class="fa fa-arrow-circle-right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                Lead Color:
                                <button class="btn btn-xs btn-default" ng-click="dCnt.changeColor('none')"><i class="fa fa-dot-circle-o"></i></button>
                                <button class="btn btn-xs btn-info" ng-click="dCnt.changeColor('info')"><i class="fa fa-dot-circle-o"></i></button>
                                <button class="btn btn-xs btn-warning" ng-click="dCnt.changeColor('warning')"><i class="fa fa-dot-circle-o"></i></button>
                                <button class="btn btn-xs btn-danger" ng-click="dCnt.changeColor('danger')"><i class="fa fa-dot-circle-o"></i></button>
                                <button class="btn btn-xs btn-success" ng-click="dCnt.changeColor('success')"><i class="fa fa-dot-circle-o"></i></button>
                            </div>
                        </div>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <h3 class="detail-section-title">
                                <span class="label label-primary">
                                    Comments
                                </span>&nbsp;<button class="btn btn-xs btn-primary" ng-click="dCnt.showCommentForm = true">
                                            <i class="fa fa-plus"></i>
                                        </button>&nbsp;<button class="btn btn-xs btn-info" ng-click="dCnt.addToCalendarForm = true">
                                            <i class="fa fa-calendar-plus-o"></i>
                                        </button>
                                    </h3>
                                    <form ng-show="dCnt.addToCalendarForm" ng-submit="dCnt.addToCalendar">
                                        <div class="well well-sm">

                                            <h4 class="text-primary">
                                                Schedule a Callback
                                            </h4>
                                            <div class="form-group form-group-sm">
                                                <label>Choose Date</label>
                                                <datepicker date-format="M/d/yyyy" date-typer="true">
                                                    <input class="form-control" ng-model="dCnt.newCalendarItem.date" placeholder="9/4/1975" type="text"/>
                                                </datepicker>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group form-group-sm">
                                                        <label>Hour</label>
                                                        <input placeholder="11" type="text" class="form-control" ng-model="dCnt.newCalendarItem.hour">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group form-group-sm">
                                                        <label>Minute</label>
                                                        <input placeholder="15" type="text" class="form-control" ng-model="dCnt.newCalendarItem.minute">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group form-group-sm">
                                                        <label>AM/PM</label>
                                                        <select class="form-control" ng-model="dCnt.newCalendarItem.ampm" ng-options="ampm for ampm in ['AM','PM']"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" ng-click="dCnt.clearCalendarForm()" class="btn btn-xs btn-warning">Cancel</button>
                                            <button type="submit" class="btn btn-xs btn-success">Save</button>
                                        </div>
                                    </form>
                                    <form ng-show="dCnt.showCommentForm" ng-submit="dCnt.saveComment()">
                                        <div class="well well-sm">

                                            <div class="form-group form-group-sm">

                                                <textarea class="form-control" ng-model="dCnt.newComment"></textarea>
                                            </div>
                                            <button type="button" ng-click="dCnt.clearCommentForm()" class="btn btn-xs btn-warning">Cancel</button>
                                            <button type="submit" class="btn btn-xs btn-success">Save</button>
                                        </div>
                                    </form>
                                    <div class="list-group">
                                        <div class="list-group-item" ng-repeat="comment in dCnt.filteredComments | orderBy:'-date'">
                                            <div class="text-primary">
                                                {{comment.body}}
                                            </div>
                                            <div>
                                                {{comment.date | formatDateTime}} by {{comment.userName}} <button class="btn btn-xs btn-danger" ng-click="dCnt.deleteComment(comment)"><i class="fa fa-trash"></i></button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3" ng-if="dCnt.isAdmin">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <h3 class="detail-section-title">
                                        <span class="label label-primary">
                                            Status Changes
                                        </span>
                                    </h3>
                                    <div class="list-group">
                                        <div class="list-group-item" ng-repeat="status in dCnt.lead.statuses | orderBy:'-date'">
                                            <h3 class="list-group-item-heading">
                                                {{status.name}}
                                            </h3>
                                            <div>
                                                {{status.date | formatDateTime}} by {{status.userName}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <h3 class="detail-section-title">
                                        <span class="label label-primary">
                                            Turn Down History
                                        </span>
                                    </h3>
                                    <div class="list-group">
                                        <div class="list-group-item" ng-repeat="td in dCnt.lead.turnDowns | orderBy:'-date'">
                                            <h4 class="list-group-item-heading">{{td.type}} - {{td.reason}}</h4>
                                            {{td.date | formatDate}} by {{td.userName}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="detail-panel">
                                    <h3 class="detail-section-title">
                                        <span class="label label-primary">
                                            Applications
                                        </span>
                                    </h3>
                                    <div class="list-group">
                                        <div class="list-group-item" ng-repeat="app in dCnt.lead.applications | orderBy:'-date'">
                                            {{app.date | formatDate}} by {{app.userName}}
                                            <span ng-if="dCnt.canViewApplication(app)">
                                                <button ng-click="dCnt.editApp(app)" class="btn btn-xs btn-info">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <button type="button" ng-click="dCnt.hideModal()" id="detail-modal-close" class="btn btn-lg btn-link">
            close <i class="fa fa-close"></i>
        </button>
    </div>
</div>

<!-- NEW LOAN -->

<div id="edit-prop" ng-controller="EditPropController as pCntl">
    <div id="edit-prop-mask"></div>
    <div id="edit-prop-paper">
        <div class="container-fluid">
            <form id="edit-prop-form" ng-submit="pCntl.save()">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>
                            <span ng-show="pCntl.lead._id">Edit Lead</span>
                            <span ng-hide="pCntl.lead._id">New Lead</span>
                        </h2>
                    </div>
                    <div class="col-sm-6">
                        <div style="margin-top:20px;" class="btn-group pull-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button ng-click="pCntl.cancel()" class="btn btn-warning">Cancel</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group-sm">
                            <label class="county-filter-box">
                                <input name="firstTime" type="radio" value="true" ng-model="pCntl.lead.isFirstTime"> First Time
                            </label>
                            <label class="county-filter-box">
                                <input name="firstTime" type="radio" value="false" ng-model="pCntl.lead.isFirstTime"> HECM to HECM
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="text-primary">Owner <span class="label label-primary">Primary</span></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label>First <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.owner.primary.name.first">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label>Middle</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.primary.name.middle">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label>Last <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.owner.primary.name.last">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm">
                                    <label>Suffix</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.primary.name.suffix">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="text-primary">Owner <span class="label label-primary">Secondary</span></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label>First</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.secondary.name.first">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <label>Middle</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.secondary.name.middle">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group-sm">
                                    <label>Last</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.secondary.name.last">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm">
                                    <label>Suffix</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.owner.secondary.name.suffix">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="text-primary">Address</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Street 1 <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.address.street1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Street 2</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.address.street2">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>City <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.address.city">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>State <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <select required class="form-control" ng-model="pCntl.lead.address.state"
                                            ng-options="state as state for state in pCntl.states"></select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>County <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.address.county">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Zip Code <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="number" class="form-control" ng-model="pCntl.lead.address.zip" placeholder="21093">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="text-primary">Contact</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Phone 1 <span class="label label-danger"><i class="fa fa-asterisk"></i></span></label>
                                    <input required type="text" class="form-control" ng-model="pCntl.lead.phone1" placeholder="310-123-1234">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Phone 2</label>
                                    <input type="text" class="form-control" ng-model="pCntl.lead.phone2"  placeholder="310-123-1234">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group-sm">
                                    <label>Email</label>
                                    <input type="email" class="form-control" ng-model="pCntl.lead.email"  placeholder="name@address.com">
                                </div>
                            </div>
                        </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="text-primary">Property</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Estimated Value</label>
                                    <input type="number" class="form-control" ng-model="pCntl.lead.estimatedValue" placeholder="100000">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Previous Value</label>
                                    <input type="number" class="form-control" ng-model="pCntl.lead.previousValue" placeholder="100000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="text-primary">Mortgage</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Mortgage Amount</label>
                                    <input type="number" class="form-control" ng-model="pCntl.lead.mortgageAmount" placeholder="100000">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group-sm">
                                    <label>Mortgage Date</label>
                                    <datepicker date-format="M/d/yyyy" date-typer="true">
                                        <input class="form-control" ng-model="pCntl.lead.mortgageDate" placeholder="9/4/1975" type="text"/>
                                    </datepicker>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- TAKE APP -->

<div id="take-app" ng-controller="TakeAppController as aCntrl">
    <div id="take-app-mask"></div>
    <div id="take-app-paper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin-right:20px;" class="pull-left"><span class="label label-info">HECM to HECM APP</span></h1>
                    <div class="pull-left">
                        <h1 id="take-app-title">
                            {{aCntrl.lead.owner.primary.name.first}} <span ng-show="aCntrl.lead.owner.primary.name.middle">{{aCntrl.lead.owner.primary.name.middle+' '}}</span>{{aCntrl.lead.owner.primary.name.last}}
                        </h1>
                        <h2 id="take-app-address">
                            {{aCntrl.lead.address.street1}}<span ng-show="aCntrl.lead.address.street2">{{' '+aCntrl.lead.address.street2}}</span>, {{aCntrl.lead.address.city}}
                            <span ng-show="aCntrl.lead.address.city">, </span>{{aCntrl.lead.address.state}} {{aCntrl.lead.address.zip}}
                        </h2>
                    </div>

                </div>
            </div>
            <div id="take-app-scroller">
                <form  ng-submit="aCntrl.saveApp()">
                    <h2><span class="label label-primary">Borrowers</span></h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="text-primary">Borrower</h4>
                            <div class="panel panel-normal panel-default"><div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                First
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.borrower.name.first">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Middle
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.borrower.name.middle">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Last
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.borrower.name.last">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Suffix
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.borrower.name.suffix">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Date of Birth
                                            </label>
                                            <datepicker date-format="M/d/yyyy" date-typer="true">
                                                <input class="form-control" ng-model="aCntrl.app.borrower.dateOfBirth" placeholder="9/4/1975" type="text"/>
                                            </datepicker>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Social Security Number
                                            </label>
                                            <input type="text" placeholder="111-22-3333" class="form-control" ng-model="aCntrl.app.borrower.ssn">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="text-primary">Income <button type="button" ng-click="aCntrl.app.borrower.incomes.push({amount:'',source:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button></label>
                                        <div ng-repeat="income in aCntrl.app.borrower.incomes" class="form-group form-group-sm">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label>Amount</label>
                                                    <input type="text" class="form-control" ng-model="aCntrl.app.borrower.incomes[$index].amount">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label>Source</label>
                                                    <input type="text" class="form-control" ng-model="aCntrl.app.borrower.incomes[$index].source">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>&nbsp;</label>
                                                    <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.borrower.incomes.splice($index, 1)">x</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-primary">Assets <button type="button" ng-click="aCntrl.app.borrower.assets.push({amount:'',source:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button></label>
                                        <div ng-repeat="asset in aCntrl.app.borrower.assets" class="form-group-sm form-group">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label>Amount</label>
                                                    <input type="text" class="form-control" ng-model="aCntrl.app.borrower.assets[$index].amount">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label>Source</label>
                                                    <input type="text" class="form-control" ng-model="aCntrl.app.borrower.assets[$index].source">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>&nbsp;</label>
                                                    <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.borrower.assets.splice($index, 1)">x</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-primary">Co-Borrower</h4>
                            <div class="panel panel-normal panel-default"><div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                First
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.name.first">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Middle
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.name.middle">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Last
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.name.last">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Suffix
                                            </label>
                                            <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.name.suffix">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Date of Birth
                                            </label>
                                            <datepicker date-format="M/d/yyyy" date-typer="true">
                                                <input class="form-control" ng-model="aCntrl.app.coborrower.dateOfBirth" placeholder="9/4/1975" type="text"/>
                                            </datepicker>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Social Security Number
                                            </label>
                                            <input type="text" placeholder="111-22-3333" class="form-control" ng-model="aCntrl.app.coborrower.ssn">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="text-primary">Income <button type="button" ng-click="aCntrl.app.coborrower.incomes.push({amount:'',source:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button></label>
                                            <div ng-repeat="income in aCntrl.app.coborrower.incomes" class="form-group form-group-sm">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.incomes[$index].amount">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Source</label>
                                                        <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.incomes[$index].source">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.coborrower.incomes.splice($index, 1)">x</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="text-primary">Assets <button ng-click="aCntrl.app.coborrower.assets.push({amount:'',source:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button></label>
                                            <div ng-repeat="asset in aCntrl.app.coborrower.assets" class="form-group form-group-sm">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.assets[$index].amount">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Source</label>
                                                        <input type="text" class="form-control" ng-model="aCntrl.app.coborrower.assets[$index].source">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.coborrower.assets.splice($index, 1)">x</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <h2><span class="label label-primary">Contact</span></h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="text-primary">Phones <button type="button" ng-click="aCntrl.app.phones.push({number:'',description:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button> </h4>
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div ng-repeat="phone in aCntrl.app.phones" class="form-group-sm form-group">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>Type</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.phones[$index].description">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>Number</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.phones[$index].number">
                                            </div>
                                            <div class="col-sm-2">
                                                <div>
                                                    <label>&nbsp;</label>
                                                </div>
                                                <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.phones.splice($index, 1)">x</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="text-primary">Emails <button type="button" ng-click="aCntrl.app.emails.push({address:'',description:''})" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button> </h4>
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div ng-repeat="phone in aCntrl.app.emails" class="form-group form-group-sm">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>Type</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.emails[$index].description">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>Address</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.emails[$index].address">
                                            </div>
                                            <div class="col-sm-2">
                                                <div>
                                                    <label>&nbsp;</label>
                                                </div>
                                                <button type="button" class="btn-xs btn btn-danger" ng-click="aCntrl.app.emails.splice($index, 1)">x</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="text-primary">Address</h4>
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group-sm form-group">
                                        <label>Street 1</label>
                                        <input type="text" ng-model="aCntrl.app.address.street1" class="form-control">
                                    </div>
                                    <div class="form-group-sm form-group">
                                        <label>Street 2</label>
                                        <input type="text" ng-model="aCntrl.app.address.street2" class="form-control">
                                    </div>
                                    <div class="form-group-sm form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.address.city">
                                    </div>
                                    <div class="form-group-sm form-group">
                                        <label>County</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.address.county">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group-sm form-group">
                                                <label>State</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.address.state">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group-sm form-group">
                                                <label>Zip</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.address.zip">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2><span class="label label-primary">Credit</span></h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Rating</label>
                                        <div>
                                            <label>
                                                <input type="radio" value="Poor" ng-model="aCntrl.app.credit.rating"> Poor
                                            </label>
                                            <label>
                                                <input type="radio" value="Fair" ng-model="aCntrl.app.credit.rating"> Fair
                                            </label>
                                            <label>
                                                <input type="radio" value="Good" ng-model="aCntrl.app.credit.rating"> Good
                                            </label>
                                            <label>
                                                <input type="radio" value="Great" ng-model="aCntrl.app.credit.rating"> Great
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Score</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.credit.score">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>30 day late payment on CC or Loans in last 2 yrs?</label>
                                        <div>
                                            <label>
                                                <input type="radio" value="Yes" ng-model="aCntrl.app.credit.lates"> Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="No" ng-model="aCntrl.app.credit.lates"> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Lapses in Homeowner's Insurance in last 12 months?</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.credit.insuranceLates"></textarea>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Problems paying property taxes in last 2 yrs?</label>
                                        <textarea  class="form-control" ng-model="aCntrl.app.credit.taxLates"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <h2><span class="label label-primary">Mortgage Statement</span></h2>


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Current Bank</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.bank">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Year Taken</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.year">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Current Balance</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.balance">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Date of Statement</label>
                                        <datepicker date-format="M/d/yyyy" date-typer="true">
                                            <input type="text" class="form-control" ng-model="aCntrl.app.loan.year">
                                        </datepicker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Original Principal Limit</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.originalPrincipleLimit">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Growth</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.growth">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Rate</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.loan.rate">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Rate Type</label>
                                        <div>
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.type" value="Fixed"> Fixed
                                            </label>
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.type" value="Adjustable"> Adjustable
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <label>Line of Credit</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.lineOfCredit.available" value="Yes"> Yes
                                            </label>
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.lineOfCredit.available" value="No"> No
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Amount</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.loan.lineOfCredit.amount">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label>Loan #</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.loan.lineOfCredit.number">
                                            </div>
                                        </div>
                                    </div>


                                    <label>Taking a Payment</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.takingPayment.available" value="Yes"> Yes
                                            </label>
                                            <label>
                                                <input type="radio" ng-model="aCntrl.app.loan.takingPayment.available" value="No"> No
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Amount/Month</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.loan.takingPayment.amountPerMonth">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <h2><span class="label label-primary">Home Info</span></h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Old Value</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.home.oldValue">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Client's Estimate</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.home.clientEstimate">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Zillow</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.home.zestimate">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label># Beds Above Ground</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.bedrooms">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label># Bathrooms</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.bathrooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label># Stories</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.stories">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Square Feet</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.squareFeet">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Type of Home</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.home.type">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Year Built</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.yearBuilt">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Acres</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.acres">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>
                                            Homeowners's Assoc? <input type="radio" ng-model="aCntrl.app.loan.home.hoa.have" value="Yes"> Yes <input type="radio" ng-model="aCntrl.app.loan.home.hoa.have" value="No"> No
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Name</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.hoa.name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-sm">
                                                <label>Amount/Year</label>
                                                <input type="text" class="form-control" ng-model="aCntrl.app.home.hoa.amountPerYear">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group form-group-sm">
                                        <label>Home upgrades past 10 years</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.home.upgrades.description"></textarea>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label>Hardwood Floors?  Describe.</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.home.upgrades.hardwoodFloors"></textarea>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label>Bathroom Upgrades?  Describe.</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.home.upgrades.bathroom"></textarea>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label>Kitchen Upgrades?  Describe.</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.home.upgrades.kitchen"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group form-group-sm">
                                <label>Things that need fixing?  Describe.</label>
                                <textarea class="form-control" ng-model="aCntrl.app.home.needFixing"></textarea>
                            </div>

                            <div class="form-group form-group-sm">
                                <label>Client Home Rating (1-10)</label>
                                <input type="text" class="form-control" ng-model="aCntrl.app.home.customerRating">
                            </div>

                            <div class="form-group form-group-sm">
                                <label>Need $ for right away? Describe.</label>
                                <textarea class="form-control" ng-model="aCntrl.app.needMoneyFor.description"></textarea>
                            </div>

                            <div class="form-group form-group-sm">
                                <label>How Much?</label>
                                <input type="text" class="form-control" ng-model="aCntrl.app.needMoneyFor.howMuch">
                            </div>

                            <div class="form-group form-group-sm">
                                <label>Any Liens or Judgements? Describe.</label>
                                <textarea class="form-control" ng-model="aCntrl.app.liensOrJudgements"></textarea>
                            </div>

                        </div>

                    </div>

                    <h2><span class="label label-primary">Notes</span></h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Lead Source</label>
                                        <input type="text" class="form-control" ng-model="aCntrl.app.source">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Follow Up Date</label>
                                        <datepicker date-format="M/d/yyyy" date-typer="true">
                                            <input class="form-control" ng-model="aCntrl.app.appFollowUp" placeholder="9/4/1975" type="text"/>
                                        </datepicker>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-8">
                            <div class="panel panel-normal panel-default">
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label>Notes</label>
                                        <textarea class="form-control" ng-model="aCntrl.app.notes"></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <hr />

                    <button type="button" class="btn btn-warning btn-lg" ng-click="aCntrl.clearForm()">Cancel</button>
                    <button type="button" class="btn btn-danger btn-lg" ng-click="aCntrl.hideModal()">Close</button>
                    <button type="button" class="btn btn-info btn-lg" ng-click="aCntrl.print()">Print</button>
                    <button ng-if="aCntrl.canSaveApp" type="submit" class="btn btn-success btn-lg">Save</button>

                </form>
            </div>
        </div>
        <button type="button" ng-click="aCntrl.hideModal()" id="take-app-close" class="btn btn-lg btn-link">
            close <i class="fa fa-close"></i>
        </button>
    </div>
</div>


<!-- DOCS OUT -->

<div id="docs-out" ng-controller="DocsOutController as doCntrl">
    <div id="docs-out-mask"></div>
    <div id="docs-out-paper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin-right:20px;" class="pull-left"><span class="label label-warning">DOCS OUT FORM</span></h1>
                    <div class="pull-left">
                        <h1 id="take-app-title">
                            {{doCntrl.lead.owner.primary.name.first}} <span ng-show="doCntrl.lead.owner.primary.name.middle">{{doCntrl.lead.owner.primary.name.middle+' '}}</span>{{doCntrl.lead.owner.primary.name.last}}
                        </h1>
                        <h2 id="take-app-address">
                            {{doCntrl.lead.address.street1}}<span ng-show="doCntrl.lead.address.street2">{{' '+doCntrl.lead.address.street2}}</span>, {{doCntrl.lead.address.city}}
                            <span ng-show="doCntrl.lead.address.city">, </span>{{doCntrl.lead.address.state}} {{doCntrl.lead.address.zip}}
                        </h2>
                    </div>

                </div>
            </div>
        </div>
        <div id="docs-out-scroller">
            <form ng-submit="doCntrl.saveForm()">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-primary">Borrower</h4>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                First
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.borrower.name.first">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Middle
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.borrower.name.middle">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Last
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.borrower.name.last">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Suffix
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.borrower.name.suffix">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-primary">Co-Borrower</h4>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                First
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.coborrower.name.first">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Middle
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.coborrower.name.middle">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Last
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.coborrower.name.last">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group form-group-sm">
                                            <label>
                                                Suffix
                                            </label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.coborrower.name.suffix">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="text-primary">
                    Address
                </h4>
                <div class="panel panel-normal panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        Street 1
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.street1">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        Street 2
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.street2">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        City
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.city">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        County
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.county">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        State
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.state">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm form-group">
                                    <label>
                                        Zip
                                    </label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.address.zip">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="text-primary">General</h4>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="form-group form-group-sm">
                                    <label>Lender</label>
                                    <input type="text" class="form-control" ng-model="doCntrl.form.lender">
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Loan Type</label>
                                    <div>
                                        <label><input type="radio" ng-model="doCntrl.form.loanType" value="Refi"> Refi</label>
                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.loanType" value="Purchase"> Purchase
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>Loan Amount</label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.loan.amount">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>Loan Balance</label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.loan.balance">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>Front Fee</label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.fee.front">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-sm">
                                            <label>Back Fee</label>
                                            <input type="text" class="form-control" ng-model="doCntrl.form.fee.back">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h4 class="text-primary">Product</h4>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Forward</h4>
                                        <div class="panel panel-normal panel-default">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label>Type</label>
                                                    <div>
                                                        <label><input type="radio" ng-model="doCntrl.form.product.forward.which" value="Conv"> Conv</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.forward.which" value="Jumbo"> Jumbo</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.forward.which" value="FHA"> FHA</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.forward.which" value="VA"> VA</label>
                                                    </div>
                                                </div>
                                                <div ng-show="['FHA','VA'].indexOf(doCntrl.form.product.forward.which) >= 0" class="form-group form-group-sm">
                                                    <div>
                                                        <strong>Streamlined:</strong> <label><input type="radio" ng-model="doCntrl.form.product.forward.streamline" value="Yes"> Yes</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.forward.streamline" value="No"> No</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Start Rate</label>
                                                            <input type="text" class="form-control" ng-model="doCntrl.form.product.forward.startRate">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <div>
                                                                <label>Escrow</label> <label><input type="radio" ng-model="doCntrl.form.product.forward.escrow" value="Yes"> Yes</label>
                                                                &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.forward.escrow" value="No"> No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>LTV</label>
                                                            <input type="text" class="form-control" ng-model="doCntrl.form.product.forward.ltv">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>CLTV</label>
                                                            <input type="text" class="form-control" ng-model="doCntrl.form.product.forward.cltv">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Term (Years)</label>
                                                            <input type="text" class="form-control" ng-model="doCntrl.form.product.forward.term">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>ARM Term (Years)</label>
                                                            <input type="text" class="form-control" ng-model="doCntrl.form.product.forward.armTerm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Reverse</h4>
                                        <div class="panel panel-normal panel-default">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label>Type</label>
                                                    <div>
                                                        <label><input type="radio" ng-model="doCntrl.form.product.reverse.which" value="FTR"> FTR</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.reverse.which" value="H2H"> H2H</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.reverse.which" value="Adjustable"> Adjustable</label>
                                                        &nbsp;<label><input type="radio" ng-model="doCntrl.form.product.reverse.which" value="Fixed"> Fixed</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label>Rate/Margin</label>
                                                    <input type="text" class="form-control" ng-model="doCntrl.form.product.reverse.margin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-primary">
                            Lead Type
                        </h4>
                        <div class="panel panel-normal panel-default"><div class="panel-body">
                            <label><input type="radio" ng-model="doCntrl.form.leadType" value="Dialer"> Dialer</label>
                            &nbsp;<label><input type="radio" ng-model="doCntrl.form.leadType" value="Personal Mailer"> Personal Mailer</label>
                            &nbsp;<label><input type="radio" ng-model="doCntrl.form.leadType" value="Company Mailer"> Company Mailer</label>
                            &nbsp;<label><input type="radio" ng-model="doCntrl.form.leadType" value="Cold Call"> Cold Call</label>
                            &nbsp;<label><input type="radio" ng-model="doCntrl.form.leadType" value="Referral"> Referral</label>
                        </div></div>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-primary">
                            Docs Delivery Method
                        </h4>
                        <div class="panel panel-normal panel-default"><div class="panel-body">
                                <div class="form-group form-group-sm">
                                    <label><input type="radio" ng-model="doCntrl.form.docsDelivery" value="UPS Delivery"> UPS Delivery</label>
                                    &nbsp;<label><input type="radio" ng-model="doCntrl.form.docsDelivery" value="Email"> Email</label>
                                    &nbsp;<label><input type="radio" ng-model="doCntrl.form.docsDelivery" value="Faxed"> Faxed</label>
                                    &nbsp;<label><input type="radio" ng-model="doCntrl.form.docsDelivery" value="LO Face to Face"> LO Face to Face</label>
                                    &nbsp;<label><input type="radio" ng-model="doCntrl.form.docsDelivery" value="Notary"> Notary</label>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Expected Delivery Date</label>
                                    <datepicker date-format="M/d/yyyy" date-typer="true">
                                        <input type="text" class="form-control" ng-model="doCntrl.form.expectedDeliveryDate">
                                    </datepicker>
                                </div>
                        </div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-primary">
                            Notes
                        </h4>
                        <div class="panel panel-normal panel-default">
                            <div class="panel-body">
                                <div class="form-group form-group-sm">
                                    <textarea class="form-control" ng-model="doCntrl.form.notes">

                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />

                <button type="button" class="btn btn-warning btn-lg" ng-click="doCntrl.clearForm()">Cancel</button>
                <button type="button" class="btn btn-danger btn-lg" ng-click="doCntrl.hideModal()">Close</button>
                <button type="button" class="btn btn-info btn-lg" ng-click="doCntrl.print()">Print</button>
                <button type="submit" class="btn btn-success btn-lg">Save</button>

            </form>
        </div>
        <button ng-click="doCntrl.hideModal()" id="docs-out-close" class="btn btn-lg btn-link">
            close <i class="fa fa-close"></i>
        </button>
    </div>
</div>

<div id="dialModal" class="modal fade" role="dialog" ng-controller="DialModalController as dialCnt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Click to Dial</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-info">{{dialCnt.owner}}</h4>
                <p>{{dialCnt.address}}</p>
                <div class="list-group-item">
                    <button ng-repeat="phone in dialCnt.phones" class="list-group-item list-group-item-success" ng-click="dialCnt.callPhone(phone.number)" ng-if="phone.status == 'Good'">
                        {{phone.number}} - {{phone.source}}<span ng-if="phone.phoneType == 'Mobile'"> <i class="fa fa-mobile-phone"></i></span> - {{phone.status}}
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="loader">
    <div id="mask"></div>
    <div id="spinner">
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-success"></div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL;?>assets/js/framework-<?php echo $version;?>.min.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/c1-<?php echo $version;?>.min.js"></script>
</body>
</html>
