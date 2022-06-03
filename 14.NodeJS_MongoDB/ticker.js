var http = require('http');
var fs = require('fs');
var qs = require('querystring');
var mongo = require('mongodb');
var client = mongo.MongoClient;
var url = "mongodb+srv://person:Alc0n0xDetergent@cluster0.40x5c.mongodb.net/stock_symbol?retryWrites=true&w=majority";

http.createServer(function (req, res) 
{
  
  if (req.url == "/")
  {
      file = 'search.html';
      fs.readFile(file, function(err, txt) {
      res.writeHead(200, {'Content-Type': 'text/html'});
      res.write(txt);
      res.end();
      });
  }
  else if (req.url == "/process")
  {
     res.writeHead(200, {'Content-Type':'text/html'});
     // res.write ("Process the form<br>");
     pdata = "";
     req.on('data', data => {
       pdata += data.toString();
     });

    // when complete POST data is received
    req.on('end', () => {
        var data = qs.parse(pdata);
        var query = data["search_query"];
        var method = data["query"];
        if (method == "company_name" || method == "stock_symbol" )
        {        
            client.connect(url, function(err, db)
            {
                console.log("connected");
                var dbObj = db.db("stock_symbols");
                var collection = dbObj.collection("companies");
                let s = "<h1 style = 'text-align: center; color: #FA26A0;'> Company Stock Ticker Search</h1>";  
                s += "<hr  style = 'border-top: 5px cyan dotted;'>"
                s += "<div style = 'margin-left: 33%; margin-right: 33%; width: 33%; font-size: 22px; text-align: center; line-height = 25px;'>";         
                if (method == "company_name")
                {
                    collection.find({Company: query}).toArray(function(err, results) 
                    {
                        if (err) throw err;
                        s += "<div>Company: " + query + "</div>"; 
                        if (results.length == 0)
                            s += "<div style = 'color: red; line-height: 55px;'>No results found</div>"
                        for (i = 0; i < results.length; i++)
                        {
                            s += "<div>Ticker symbol: " + results[i].Ticker + "</div>";
                        }
                        res.write("</div>" + s); 
                        db.close();
                    }); //end company to array 
                } //end if checking method name 
                else 
                {
                    collection.find({Ticker: query}).toArray(function(err, results) 
                    {
                        if (err) throw err;
                        s += "<div>Ticker symbol: " + query + "</div><div>"
                        if (results.length == 0)
                            s += "<div style = 'color: red; line-height: 55px;'>No results found</div>"
                        else 
                            s += "Corresponding companies: </div>"; 
                        for (i = 0; i < results.length; i++)
                        {
                            s += "<div>" + results[i].Company + "</div>"; 
                        }
                        res.write("</div>" + s); 
                        db.close();
                    }); //end ticker to array 
                } //end else checking method name        
                
            }); //end connect
        }// end if statement
        
        res.end(); 
    });
    
  }
  else 
  {
      res.writeHead(200, {'Content-Type':'text/html'});
      res.write ("Unknown page request");
      // res.end();
  }


}).listen(8080);