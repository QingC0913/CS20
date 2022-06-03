var fs = require('fs'); 
var mongo = require('mongodb');
var client = mongo.MongoClient;
var url = "mongodb+srv://person:Alc0n0xDetergent@cluster0.40x5c.mongodb.net/myFirstDatabase?retryWrites=true&w=majority";

var file = "companies.csv";
//read file
var text = fs.readFileSync(file, 'UTF-8');
//store each line separately 
var lines = text.split(/\r?\n/);
client.connect(url, function(err, db)
{
    if (err)
    {
        console.log("error: " + err); 
        return;
    }//end if 
    
    console.log("success!");
    var dbObj = db.db("stock_symbols");
    var collection = dbObj.collection("companies");

    lines.forEach((line) => 
    {
        var comma_index = line.indexOf(',');
        var company_nm = line.substring(0, comma_index); 
        var symbol = line.substring(comma_index + 1); 
        if (company_nm != "Company" && company_nm != ""  && symbol != "Ticker" && symbol != "")
        {
            collection.insertOne({Company: company_nm, Ticker: symbol});
            console.log("SUCCESSFULLY INSERTED: {Company: " + company_nm + ", Ticker: " + symbol +"}"); 
        }//end if 
    db.close();
})//end foreach
}); //end connect