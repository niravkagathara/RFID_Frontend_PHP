const express = require('express');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors());
const Student = require('./model/Student');
const LatestUID = require("./model/latestUID");
const Attendance = require("./model/attendance");

// const { isEmpty } = require('validator');

// app.use(express.static('./public'));
// const adminRoutes = require("./routes/adminRoutes");
// const studentRoutes = require("./routes/studentRoutes");
// const attendanceRoutes = require("./routes/attendanceRoutes");
// const latestUIDRoutes = require("./routes/latestUIDRoutes");

// app.use("/api/admin", adminRoutes);
// app.use("/api/students", studentRoutes);
// app.use("/api/attendance", attendanceRoutes);
// app.use("/api/latest-uid", latestUIDRoutes);
async function insertUID(uid) {
    try {
        // Insert or Update the latest UID (Equivalent to MySQL ON DUPLICATE KEY UPDATE)
        await LatestUID.findOneAndUpdate(
            { uid: uid }, // Find existing UID
            { uid: uid }, // Update if exists
            { upsert: true, new: true } // Insert if not found
        );

        // Keep only the latest UID and delete all older UIDs
        const latestUIDs = await LatestUID.find().sort({ createdAt: -1 }).limit(1);
        if (latestUIDs.length > 0) {
            await LatestUID.deleteMany({ _id: { $nin: latestUIDs.map(doc => doc._id) } });
        }
        return "UID Updated Successfully";
    } catch (error) {
        console.error("Error updating UID:", error);
        return "Error updating UID";
    }
}
app.get('/', (req, resp) => {
    resp.send('Welcome to the Student API 🚀');
});
app.get('/rfid', async (req, resp) => {
    const latestUid = await LatestUID.findOne().sort({ _id: -1 }).select("uid");
    resp.status(200).send({uid:latestUid.uid});

});
app.post('/rfid', async (req, resp) => {
    if (req.body.uid) {
        let uida = await Student.findOne(req.body);
        // console.log(uida);
        let insert_uid = await insertUID(req.body.uid);
        if (insert_uid == "UID Updated Successfully") {
            console.log("latest uid inserted");
        }
        // console.log(insert_uid);
        if (uida) {
            var uid = uida.uid;
            var student_id = uida._id;
            var status = "Present";
            var date = new Date(); // Current Date
            var time = new Date().toLocaleTimeString(); // Current Time
            var enrollment = uida.enrollment;
            try {
                // Insert attendance record
                const newAttendance = new Attendance({
                    uid: uid,
                    student_id: student_id,
                    status: status,
                    date: date,
                    time: time,
                });

                await newAttendance.save();

                // Send success response
                resp.status(200).send({
                    status_code: 200,
                    message1: "    Present    ",
                    message2: enrollment
                });
            } catch (error) {
                resp.status(500).send({
                    status_code: 500,
                    message: "Error inserting attendance",
                    error: error.message
                });
            }
        }
        else {
            resp.status(200).send({ status_code: 301, message1: "", message2: "Not Allowed!" });
        }
    }
    else if (req.body.msg) {
        if (req.body.msg == "Student Record Added Successfully") {
            resp.status(200).send({ status_code: 302, message1: "Add new student", message2: "  Successfully  " });
        }
        else if (req.body.msg == "Student Record Updated Successfully") {
            resp.status(200).send({ status_code: 303, message1: "Student updated", message2: "  Successfully  " });
        }
        else {
            resp.status(200).send({ status_code: 304, message1: " Add or Update ", message2: "     Error     " });

        }
    }
    else {
        resp.status(200).send({ status_code: 404, message1: "Api error or system error", message2: "                " });

    }
    // resp.status(200).send({user:user,token:token,role:role,id:id});
});

module.exports = app;
