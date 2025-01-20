const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'mysql-daneroarama.alwaysdata.net',
    user: '391055',
    password: 'ABC!@#$%^DEF',
    database: 'daneroarama_users'
});

exports.handler = (req, res) => {
    if (req.method === 'POST') {
        const { login_email, login_password, name, phone, email, password } = req.body;

        if (req.body.login) {
            // Authenticate user logic
            const sql = `SELECT * FROM users WHERE email='${login_email}' AND password='${login_password}'`;
            connection.query(sql, (error, results) => {
                if (error) {
                    console.error(error);
                    return res.status(500).json({ message: 'Database error' });
                }
                if (results.length > 0) {
                    // User authenticated
                    res.status(200).json({ message: 'Login successful', user: results[0] });
                } else {
                    res.status(401).json({ message: 'Invalid email or password' });
                }
            });
        } else if (req.body.register) {
            // Register user logic
            const sql = `INSERT INTO users (name, phone, email, password) VALUES ('${name}', '${phone}', '${email}', '${password}')`;
            connection.query(sql, (error, results) => {
                if (error) {
                    console.error(error);
                    return res.status(500).json({ message: 'Database error' });
                }
                res.status(200).json({ message: 'Registration successful' });
            });
        }
    } else {
        res.setHeader('Allow', ['POST']);
        res.status(405).end(`Method ${req.method} Not Allowed`);
    }
}; 