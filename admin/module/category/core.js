app.controller("add", function($scope, appService) {
  let self = this;

  self.field = {
    name: ""
  };
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
      location.href = "index.php?module=category&mode=remove&id=" + self.tmp.id;
  }

  self.cancelRemove = () => {
    self.tmp = {
        name :'',
        id:''
      };
}
});

app.controller("edit", function($scope, appService) {
  let self = this;

  self.field = {
    name: ""
  };

  
});
