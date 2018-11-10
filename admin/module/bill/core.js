app.controller("add", function($scope, appService) {
  let self = this;

  self.field = {
    name: "",
    sname: "",
    number: "",
  };

  self.check = () => {
    if(self.field.name == "" || self.field.sname == "" || self.field.number == "" || self.field.account_name == "" ) {
      return false;
    }
    return true;
  }
});



app.controller("manage", function($scope, appService) {
  let self = this;

  self.field = {
    name: ""
  };

  self.wait_for_ship = (id) => {
    location.href = "index.php?module=bill&mode=action_wait_for_ship&id=" + id;
  }

  self.reject = (id) => {
    location.href = "index.php?module=bill&mode=action_reject&id=" + id;
  }

  self.shipped = (id) => {
    location.href = "index.php?module=bill&mode=action_shipped&id=" + id;
  }

  self.wait_for_trans = (id) => {
    location.href = "index.php?module=bill&mode=action_wait_for_trans&id=" + id;
  }

  self.wait_for_confirm = (id) => {
    location.href = "index.php?module=bill&mode=action_wait_for_confirm&id=" + id;
  }

  self.remove = (name, id) => {
    self.tmp = {
      name,
      id
    };

    $("#remove").modal({ backdrop: "static" }, "show");
  };

  self.goRemove = () => {
      location.href = "index.php?module=bill&mode=remove&id=" + self.tmp.id;
  }

  self.cancelRemove = () => {
    self.tmp = {
        name :'',
        id:''
      };
}
});

app.controller("manageBank", function($scope, appService) {
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
      location.href = "index.php?module=bill&mode=removeBank&id=" + self.tmp.id;
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
