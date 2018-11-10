app.controller("add", function($scope, appService) {
    let self = this;

    self.field = {
        name: "",
        description: "",
        image: "",
        price: "",
        stock: "",
        category_id: ""
    };

    self.check = () => {
        let result = true;
        $.each(self.field, function(key, value) {
            // console.log(self.field[key]);
            if (self.field[key] == '') {
                result = false;
            }
        });

        return result;
    }
});

app.controller("manage", function($scope, appService) {
    let self = this;

    self.field = {
        name: ""
    };

    self.remove = (name, id) => {
        self.tmp = {
            name,
            id
        };

        $("#remove").modal({ backdrop: "static" }, "show");
    };

    self.goRemove = () => {
        location.href = "index.php?module=page&mode=remove&id=" + self.tmp.id;
    }

    self.cancelRemove = () => {
        self.tmp = {
            name: '',
            id: ''
        };
    }
});

app.controller("edit", function($scope, appService) {
    let self = this;

    self.field = {
        name: ""
    };


});