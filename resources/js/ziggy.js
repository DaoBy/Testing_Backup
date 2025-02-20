const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"tracking":{"uri":"tracking","methods":["GET","HEAD"]},"request.delivery":{"uri":"request","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"customer.home":{"uri":"customer\/home","methods":["GET","HEAD"]},"customer.register":{"uri":"customer\/register","methods":["GET","HEAD"]},"customer.":{"uri":"customer\/confirm-password","methods":["POST"]},"customer.login":{"uri":"customer\/login","methods":["GET","HEAD"]},"customer.logout":{"uri":"customer\/logout","methods":["POST"]},"customer.dashboard":{"uri":"customer\/dashboard","methods":["GET","HEAD"]},"employee.register":{"uri":"employee\/register","methods":["GET","HEAD"]},"employee.":{"uri":"employee\/confirm-password","methods":["POST"]},"employee.login":{"uri":"employee\/login","methods":["GET","HEAD"]},"employee.logout":{"uri":"employee\/logout","methods":["POST"]},"employee.admin.dashboard":{"uri":"employee\/admin\/dashboard","methods":["GET","HEAD"]},"employee.staff.dashboard":{"uri":"employee\/staff\/dashboard","methods":["GET","HEAD"]},"employee.driver.dashboard":{"uri":"employee\/driver\/dashboard","methods":["GET","HEAD"]},"employee.collector.dashboard":{"uri":"employee\/collector\/dashboard","methods":["GET","HEAD"]},"profile.edit":{"uri":"profile","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"customer.password.request":{"uri":"customer\/forgot-password","methods":["GET","HEAD"]},"customer.password.email":{"uri":"customer\/forgot-password","methods":["POST"]},"customer.password.reset":{"uri":"customer\/reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"customer.password.store":{"uri":"customer\/reset-password","methods":["POST"]},"customer.password.confirm":{"uri":"customer\/confirm-password","methods":["GET","HEAD"]},"customer.password.update":{"uri":"customer\/password","methods":["PUT"]},"employee.password.request":{"uri":"employee\/forgot-password","methods":["GET","HEAD"]},"employee.password.email":{"uri":"employee\/forgot-password","methods":["POST"]},"employee.password.reset":{"uri":"employee\/reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"employee.password.store":{"uri":"employee\/reset-password","methods":["POST"]},"employee.verification.notice":{"uri":"employee\/verify-email","methods":["GET","HEAD"]},"employee.verification.verify":{"uri":"employee\/verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"employee.verification.send":{"uri":"employee\/email\/verification-notification","methods":["POST"]},"employee.password.confirm":{"uri":"employee\/confirm-password","methods":["GET","HEAD"]},"employee.password.update":{"uri":"employee\/password","methods":["PUT"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
