var data = [];
function twitter_init(){
   OAuth.initialize('mlUDFwTADp67UEpL0iNsEzr3Du0');
    OAuth.popup('twitter',function(err, res){
          localStorage.setItem("oauth_token", res.oauth_token); 
          localStorage.setItem("oauth_token_secret", res.oauth_token_secret); 
    }).then( function(){
             OAuth.callback('twitter',  "http://oldera.html.xdomain.jp");
    });
}
function getTwitterTL(){
    let options = {
        method: "GET",
        apiURL: "https://api.twitter.com/1.1/statuses/user_timeline.json",
        count: 10,
        consumerKey: "d9ktYK8Pj12uAiBB6qX4wZGwD",
        consumerSecret: "X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh",
        accessToken:  localStorage.getItem("oauth_token"),
        tokenSecret:   localStorage.getItem("oauth_token_secret")
    };
    let accessor = {
        consumerSecret: options.consumerSecret,
        tokenSecret: options.tokenSecret
    };
    let message = {
        method: options.method,
        action: options.apiURL,      
        parameters: {
            count: options.count,
            oauth_version: "1.0",
            oauth_signature_method: "HMAC-SHA1",
            oauth_consumer_key: options.consumerKey,
            oauth_token: options.accessToken,
            callback: "cbname1"
        }
    };
    OAuth1.setTimestampAndNonce(message);
    OAuth1.SignatureMethod.sign(message, accessor);
    var url = OAuth1.addToURL(message.action, message.parameters);
    $.ajax({
        type: options.method,
        url: url,
        dataType: "jsonp",
        jsonp: false,
        cache: true
    });
}
function SendTwitter(tweets_txt){
    let options = {
        method: "POST",
        apiURL: "https://api.twitter.com/1.1/statuses/update.json",
        consumerKey: "d9ktYK8Pj12uAiBB6qX4wZGwD",
        consumerSecret: "X2j9gdo1TjtfQLN86c43zk1KJCwLsJOfSlCHHMwVBUJS47eMsh",
        accessToken:  localStorage.getItem("oauth_token"),
        tokenSecret:   localStorage.getItem("oauth_token_secret")
    };   
    let accessor = {
        consumerSecret: options.consumerSecret,
        tokenSecret: options.tokenSecret
    };
    let message = {
        method: options.method,
        action: options.apiURL,
        parameters: {
            oauth_version: "1.0" ,
            oauth_signature_method:"HMAC-SHA1" ,
            oauth_consumer_key: options.consumerKey ,
            oauth_token: options.accessToken,
            status: tweets_txt + "",
            callback: "cbname2"
        }      
    };
    OAuth1.setTimestampAndNonce(message);
    OAuth1.SignatureMethod.sign(message, accessor);

    let url = OAuth1.addToURL(message.action, message.parameters);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },    
        type: options.method,
        url: url
    });
}
function cbname1(data){
    JSON.stringify(data);
    let count=0;
    while(count<10){
        tweetsList.push(data[count].text);
        let str_key = 'MyTL_tw' + count;
        localStorage.setItem(str_key ,tweetsList[count]);
        count = count + 1;
    }
}