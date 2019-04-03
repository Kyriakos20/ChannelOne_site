c1App.service('HelperService',['$rootScope', function($rootScope){

    this.viewUser = null;

    return {
        states: function () {
            return ['AL','AZ', 'CA', 'CO','CT', 'DC', 'DE', 'FL', 'GA','ID', 'IL', 'IN','KY', 'LA','MD', 'ME','MI','MT','NC','NE','NH', 'NJ','NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA','RI', 'SC','TN', 'TX', 'VA', 'WA'];
        },
        loan_types: function () {
            return ['Fixed', 'Adjustable', 'Both'];
        },
        dnc_options: function () {
            return ['No DNC or DNM', 'No DNC', 'No DNM', 'Only DNC', 'Only DNM', 'Only DNC and DNM'];
        },
        lead_buckets: function () {
            return ['Leads', 'Completed Apps', 'Working', 'Processing', 'Closed', 'Manager Review'];
        },
        lead_statuses: function () {
            return ['Lead', 'Paper App', 'Work Up', 'Ready to Pitch', 'Booked', 'Docs Out',
                'Docs In', 'Counselling In', 'Case Num Orderded', 'Appraisal Ordered', 'Appraisal In',
                'Submitted to Processing', 'Sent to Lender', 'Stipped', 'Clear to Close', 'Closed'];
        },
        tud_statuses: function () {
            return ['Did not like offer', 'Did not need the money', 'Did not want the hassle', 'Lost contact', 'Not enough money', 'Sat too long'];
        },
        wtd_statuses: function () {
            return ['Balance too high', 'Borrower died', 'Bad credit', 'Home damage', 'Invalid phone', 'Low income', 'Value is low', 'Closed recently'];
        },
        roles: function () {
            return ['Web Admin', 'Admin', 'Sales Manager', 'Team Manager', 'Loan Officer', 'Assistant'];
        },
        sources: function () {
            return ['Self/Referral', 'Personal Mailer', 'Dialer', 'Corporate Mailer', 'Cold Call', 'Other'];
        },
        indexTypes: function () {
            return ["CMT/TCM", "T-Bill", "MTA/MAT", "CODI", "COFI", "COSI", "LIBOR", "CD", "Prime"];
        },
        counties: null,
        users: null,
        userFilters: null,
        setViewUser: function (u) {
            this.viewUser = u;
            $rootScope.$broadcast('view-user-ready');
        },
        getViewUser: function () {
            return this.viewUser;
        }
    }
}]);
