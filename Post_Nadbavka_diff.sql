update industry.nadbavka_absolutnaya set data='15.02.2014' where data between '01.02.2014' and '28.02.2014';
insert into industry.nadbavka_absolutnaya(value,values_set_id,data,tariff_value)
select --
 sum(value),values_set_id,'28.02.2014',16.54
from industry.nadbavka_absolutnaya  where data='15.02.2014' group by values_set_id;

delete from industry.nadbavka_absolutnaya where data='15.02.2014';

update industry.sovm_absolutnyy set data='15.02.2014' where data between '01.02.2014' and '28.02.2014';
insert into industry.sovm_absolutnyy (parent_firm_id,value,data,values_set_id,tariff_value)
select --
 parent_firm_id,sum(value),'28.02.2014',values_set_id,16.54
from industry.sovm_absolutnyy  where data='15.02.2014'  group by values_set_id,parent_firm_id;

delete from industry.sovm_absolutnyy where data='15.02.2014';