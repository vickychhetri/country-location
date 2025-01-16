<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - CountryLocation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <header class="text-center mb-5">
        <h1>CountryLocation API Documentation</h1>
        <p>Base URL: <code>https://api.countrylocation.com/</code></p>
    </header>

    <section id="overview" class="mb-5">
        <h2>Overview</h2>
        <p>This API provides endpoints for user authentication and postal code management. Below are the details of the available endpoints.</p>
    </section>

    <section id="auth-endpoints" class="mb-5">
        <h2>Authentication Endpoints</h2>

        <div class="mb-4">
            <h4>1. Register</h4>
            <p><strong>POST</strong> <code>/api/register</code></p>
            <p>Registers a new user.</p>
            <h6>Request Body:</h6>
            <pre>
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
                </pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "message": "User registered successfully.",
    "token": "your-access-token"
}
                </pre>
        </div>

        <div class="mb-4">
            <h4>2. Login</h4>
            <p><strong>POST</strong> <code>/api/login</code></p>
            <p>Logs in an existing user.</p>
            <h6>Request Body:</h6>
            <pre>
{
    "email": "john.doe@example.com",
    "password": "password123"
}
                </pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "message": "Login successful.",
    "token": "your-access-token"
}
                </pre>
        </div>

        <div class="mb-4">
            <h4>3. Forgot Password</h4>
            <p><strong>POST</strong> <code>/api/forgot-password</code></p>
            <p>Sends a password reset link to the user’s email.</p>
            <h6>Request Body:</h6>
            <pre>
{
    "email": "john.doe@example.com"
}
                </pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "message": "Password reset link sent to your email."
}
                </pre>
        </div>

        <div class="mb-4">
            <h4>4. Reset Password</h4>
            <p><strong>POST</strong> <code>/api/reset-password</code></p>
            <p>Resets the user's password using a valid token.</p>
            <h6>Request Body:</h6>
            <pre>
{
    "email": "john.doe@example.com",
    "token": "reset-token",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
}
                </pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "message": "Password has been reset."
}
                </pre>
        </div>
    </section>

    <section id="postal-codes-endpoints" class="mb-5">
        <h2>Postal Codes Endpoints</h2>

        <div class="mb-4">
            <h4>1. Retrieve All Postal Codes</h4>
            <p><strong>GET</strong> <code>/api/postal-codes</code></p>
            <p>Retrieves a list of postal codes with optional filters.</p>
            <h6>Query Parameters:</h6>
            <ul>
                <li><code>postal_code</code> (string) - Filter by postal code.</li>
                <li><code>country_code</code> (string) - Filter by country code.</li>
                <li><code>admin_name1</code> (string) - Filter by administrative region.</li>
            </ul>
            <h6>Example Request:</h6>
            <pre>GET /api/postal-codes?country_code=IN</pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "data": [
        {
            "postal_code": "421605",
            "country_code": "IN",
            "place_name": "Phalegaon"
        }
    ]
}
                </pre>
        </div>

        <div class="mb-4">
            <h4>2. Retrieve Postal Code Details</h4>
            <p><strong>GET</strong> <code>/api/postal-codes/{postalCode}</code></p>
            <p>Gets detailed information about a specific postal code.</p>
            <h6>Example Request:</h6>
            <pre>GET /api/postal-codes/421605</pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "data": {
        "postal_code": "421605",
        "country_code": "IN",
        "place_name": "Phalegaon",
        "admin_name1": "Maharashtra"
    }
}
                </pre>
        </div>

        <div class="mb-4">
            <h4>3. Find Nearby Locations</h4>
            <p><strong>GET</strong> <code>/api/postal-codes/nearby/area</code></p>
            <p>Finds postal codes near a specific latitude and longitude.</p>
            <h6>Query Parameters:</h6>
            <ul>
                <li><code>latitude</code> (numeric) - Latitude of the location.</li>
                <li><code>longitude</code> (numeric) - Longitude of the location.</li>
                <li><code>radius</code> (numeric, optional) - Search radius in kilometers (default: 10).</li>
            </ul>
            <h6>Example Request:</h6>
            <pre>GET /api/postal-codes/nearby/area?latitude=19.36&longitude=73.32&radius=15</pre>
            <h6>Example Response:</h6>
            <pre>
{
    "status": "success",
    "data": [
        {
            "postal_code": "421604",
            "country_code": "IN",
            "place_name": "Nearby Place"
        }
    ]
}
                </pre>
        </div>
    </section>

    <footer class="text-center mt-5">
        <p>&copy; {{ date('Y') }} CountryLocation API. All Rights Reserved.</p>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

