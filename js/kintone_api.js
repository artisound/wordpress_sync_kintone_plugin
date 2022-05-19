const kintone_api = function(params) {
  this.exec_url = params.exec_url;
  this.domain   = params.domain;
  this.username = params.username;
  this.password = params.password;
}

kintone_api.prototype = {
  app: function(appId) {
    try {
      if(appId) {
        this.appId = appId;
      } else {
        throw 'アプリIDを指定してください。'
      }
      return this;
    } catch(e) {
      throw e;
    }
  },

  fields: function() {
    try {
      if(this.appId) {
        this.action = 'fields';
      } else {
        throw 'アプリIDを指定してください。';
      }
      return this;
    } catch(e) {
      throw e;
    }
  },

  get: async function() {
    try {
      if(this.appId) {
        let exec_url = this.exec_url + '?app_id=' + this.appId;
        if(this.action) {
          exec_url += '&action=' + this.action;
        }

        return await axios.get(exec_url, {
          headers: {
            kintone_domain  : this.domain,
            kintone_username: this.username,
            kintone_password: this.password,
          }
        });
      } else {
        throw 'アプリIDを指定してください。';
      }
    } catch(e) {
      throw e;
    }
  },

}
