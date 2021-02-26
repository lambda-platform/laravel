if (process.env.section == "lambda") {
    require(`${__dirname}/webpack.lambda.js`);
} else {
    require(`${__dirname}/webpack.app.js`);
}
