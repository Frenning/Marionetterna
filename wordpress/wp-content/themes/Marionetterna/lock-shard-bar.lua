--------------------------------------------
--            SOUL SHARDS BAR             --
--         Made by Kirin & Ipse           --
-- "The headless pigmy has terrible aim." --
--              :PeepoHappy:              --
--------------------------------------------
--       For FREE distribution ONLY       --
--------------------------------------------
local r = aura_env.region

--[[
If TrackDoom is enabled, Doom timers will show up on the bars,
    and the shard count display for Demonology will be hidden.
    If you have suggestions for better managing the display of
    both numbers, please let me know.
]]

aura_env.ColorShardsSeparately = false

local SeparateShardsColors = { -- has been removed 
    --[[
    Colors only the Foreground, other areas are
               inherited from the tables above.
    Both ARGB and RGB hex codes are acceptable.
    ]]--
    
    Shard1 = "e600ff", 
    Shard2 = "e600ff", 
    Shard3 = "e600ff", 
    Shard4 = "9310ff", 
    Shard5 = "6432ff"
}


local ShardConsumptionPrediction = {
    Enabled = true, --If false, everything else is ignored.
    Text = "", --Wraps the spending text with what ever you put here.
    Color = "ffffff" --Use an RGB hex code.
    --This will also color partial Doom ticks.
}
aura_env.cost = 0
aura_env.consuming = 0
local spec = {
    [1] = "Affliction",
    [2] = "Demonology",
    [3] = "Destruction"
}
function aura_env.SpecUpdate(SpecNumber)
    return spec[SpecNumber]
end
aura_env.currentSpec = aura_env.SpecUpdate(GetSpecialization())

function aura_env.FormatCount(pos, shards, consumed)
    -- Don't go above max soul shards
    local maxPower = UnitPowerMax("player", 7)
    if shards - consumed > maxPower then
        shards = maxPower
        consumed = 0
    end
    
    local display = aura_env.config.showText--not (c.TrackDoom and IsPlayerSpell(265412)) and "Simple"
    if display then
        local selected = aura_env.config[aura_env.currentSpec.."Text"]
        local match = aura_env.config.ShardCountOnMiddle and 3 or math.floor(shards - 0.1) + 1
        local pred = ShardConsumptionPrediction
        
        if pos == (match or math.floor(match - 0.1) + 1) then
            consumed = pred.Enabled and consumed or 0
            consumed = shards > consumed and consumed or shards
            
            if selected == 1 then--"Simple" then
                shards = shards - consumed
            elseif selected == 2 then--"Full" then
                shards = string.format("%.1f", shards - consumed)
                if shards == "0.0" then shards = 0 end
            elseif selected == 3 then--"Tenths" then
                shards = (shards - consumed)*10
            else
                return ""
            end
            
            if pred.Enabled and consumed ~= 0 then
                local open, close = pred.Text, pred.Text or pred.Text
                local color = pred.Color
                
                color = color:gsub("%W", "")
                
                local len = string.len(color)
                
                if len == 8 then
                    color = color:gsub("^%w%w", "ff")
                elseif len == 6 then
                    color = "ff"..color
                else
                    color = "ffff3200"
                end
                
                shards = WrapTextInColorCode(open..shards..close, color)
            end
            
            return shards
        else
            return ""
        end
    else
        return ""
    end
end

aura_env.Doom = aura_env.Doom or {}
aura_env.format = string.format

function aura_env.nextDoom(dest1, dest2)
    return aura_env.Doom[dest1].exp < aura_env.Doom[dest2].exp
end

--I do not understand this
local function orderednext(t, n)
    local key = t[t.__next]
    
    if not key then return end
    
    t.__next = t.__next + 1
    
    return key, t.__source[key]
end

function aura_env.orderedDoom(t, f)
    local keys, kn = {__source = t, __next = 1}, 1
    
    for k in pairs(t) do
        keys[kn], kn = k, kn + 1
    end
    
    table.sort(keys, f)
    
    return orderednext, keys
end

--Forgive our sins
aura_env.soulShardFrame = aura_env.soulShardFrame or {}

if not aura_env.soulShardFrame.Frame and aura_env.config.TrackDoom then
    local frame = CreateFrame("Frame", nil, UIParent)
    local doom = aura_env.soulShardFrame
    
    doom.Frame = frame
    
    doom.TrackDoom = aura_env.config.TrackDoom
    doom.DoomInfo = {}
    doom.UnitDebuff = WA_GetUnitDebuff
    doom.UnitGUID = UnitGUID
    
    doom.Frame:SetSize(1, 1)
    doom.Frame:SetFrameStrata("BACKGROUND")
    doom.Frame:RegisterEvent("COMBAT_LOG_EVENT_UNFILTERED")
    doom.Frame:SetScript("OnEvent", function(self)
            
            local _, event, _, source, _, _, _, dest, _, _, _, spellID = CombatLogGetCurrentEventInfo()
            
            if source == WeakAuras.myGUID and spellID == 603 and doom.TrackDoom then
                
                local sbCastTime = select(4, GetSpellInfo(686))/1000
                local spellSpeed = (68*100)*((2/sbCastTime)-1)
                local tickLength = 20*((1+(spellSpeed)/(68*100))^-1)
                
                doom.DoomInfo[dest] = doom.DoomInfo[dest] or {
                    exp = 0, dur = 0,
                    expDot = 0, durDot = 0,
                    lastTick = 0, nextTick = 0,
                    tickDuration = 0, curTickDuration = 0,
                }
                
                local d = doom.DoomInfo[dest]
                local nameplateCheck = false
                local now = GetTime()
                
                if event == "SPELL_AURA_APPLIED" then
                    d.exp, d.dur = now + d.tickDuration, d.tickDuration
                    d.expDot, d.durDot = now + d.tickDuration, d.tickDuration
                    d.lastTick, d.nextTick = 0, now + d.tickDuration
                    d.tickDuration, d.curTickDuration = tickLength, tickLength
                    
                    for i = 1, 40 do 
                        if doom.UnitGUID("nameplate"..i) == dest then
                            local npd, npe = select(5, doom.UnitDebuff("nameplate"..i, 603, "PLAYER"))
                            
                            nameplateCheck = true
                            d.exp, d.dur = npe, npd
                            d.expDot, d.durDot = npe, npd
                            d.lastTick, d.nextTick = now, npe
                            d.tickDuration, d.curTickDuration = tickLength, tickLength
                            
                            break
                        end
                    end
                    --[[
                    if not nameplateCheck then
                        d.exp, d.dur = now + tickLength, tickLength
                        d.expDot, d.durDot = now + tickLength, tickLength
                        d.lastTick, d.nextTick = 0, 0
                    end
]]
                    
                elseif event == "SPELL_AURA_REFRESH" then
                    
                    for i = 1, 40 do 
                        if doom.UnitGUID("nameplate"..i) == dest then
                            local npd, npe = select(5, doom.UnitDebuff("nameplate"..i, 603, "PLAYER"))
                            nameplateCheck = true
                            d.tickDuration = tickLength
                            d.expDot, d.durDot = npe, npd
                            
                            if d.curTickDuration + d.lastTick < npe then
                                d.exp, d.dur = d.lastTick + d.curTickDuration , d.curTickDuration
                                d.nextTick = d.lastTick + d.curTickDuration
                            else
                                d.exp, d.dur = d.expDot, d.durDot
                                d.nextTick = d.expDot
                            end
                            
                            break
                        end
                    end
                    
                    
                    --[[
                    if not nameplateCheck then
                        
                        if d.tickDuration * 0.3 > d.exp - GetTime() then
                            local remains = d.exp - now
                            d.exp, d.dur = d.tickDuration + remains + now, d.tickDuration + remains
                        end
                    end]]
                elseif event == "SPELL_PERIODIC_DAMAGE" or event == "SPELL_PERIODIC_MISSED" then
                    for i = 1, 40 do 
                        if doom.UnitGUID("nameplate"..i) == dest then
                            local npd, npe = select(5, doom.UnitDebuff("nameplate"..i, 603, "PLAYER"))
                            d.curTickDuration = d.tickDuration
                            d.dotExp, d.durDot = npe, npd
                            nameplateCheck = true
                            
                            if d.curTickDuration + now < npe then
                                d.exp, d.dur = now + d.curTickDuration , d.curTickDuration
                                d.lastTick, d.nextTick = now, now + d.curTickDuration
                            else
                                d.exp, d.dur = d.expDot, d.durDot
                                d.lastTick, d.nextTick = now, d.expDot
                            end
                            
                            break
                        end
                    end
                    
                    if not nameplateCheck then
                        if now + d.tickDuration - d.lastTick <= d.exp then
                            d.exp = now + d.tickDuration - d.lastTick
                            d.dur = now + d.tickDuration - d.lastTick
                        else
                            d.exp, d.dur = d.expDot, d.expDot - now
                        end
                        
                        d.lastTick, d.nextTick = now, now + 30
                    end
                elseif event == "SPELL_AURA_REMOVED" then
                    d.exp, d.dur = 0, 0
                    d.expDot, d.durDot = 0, 0
                    d.lastTick, d.nextTick = 0, 0
                    d.tickDuration, d.curTickDuration = 0, 0
                end
                
                WeakAuras.ScanEvents("DOOM_UPDATE")
            end   
    end)
end

aura_env.Doom = aura_env.soulShardFrame.DoomInfo

aura_env.sortAndOffset = function()
    local spacing = 0
    local count = 0
    
    local states = WeakAuras.GetTriggerStateForTrigger(aura_env.id, 1)
    local mapping = {}
    for cloneID, state in pairs(states) do
        table.insert(mapping, {state, cloneID})
    end
    
    local xOffset = 0
    local yOffset = 0
    local total = #mapping
    
    for i, data in ipairs(mapping) do
        local cloneID = data[2]
        local region = WeakAuras.GetRegion(aura_env.id, cloneID)
        if region then
            local width = region.width
            
            xOffset = 0 - (width + spacing) / 2 * (total-1) + (count * (width + spacing))
            
            region:SetAnchor("CENTER" , r, "CENTER")
            region:SetOffset(xOffset, yOffset)
            
            count = count + 1
        end
    end
end

aura_env.dynamicWidthList = {}
aura_env.dynamicWidth = function()
    wipe(aura_env.dynamicWidthList)
    for _, entry in pairs(aura_env.config.setWidth) do
        if entry.groupName ~= "" then
            local loaded = WeakAuras.IsAuraLoaded(entry.groupName)
            if loaded then
                aura_env.dynamicWidthList = {
                    groupName = entry.groupName,
                    extra = entry.extra,
                }
                break
            end
        end
    end
end
aura_env.dynamicWidth()

aura_env.sortAndOffset = function()
    aura_env.dynamicWidth()
    local data = aura_env.dynamicWidthList
    if data.groupName then
        local name = data.groupName
        local extra = data.extra
        local aura_env = aura_env
        C_Timer.After(0.1, function()
            if not InCombatLockdown() and not WeakAuras.IsOptionsOpen() then
                local region = WeakAuras.GetRegion(name)
                if region then
                    local width = region.currentWidth
                    
                    local scale = region:GetScale()
                    if scale and (scale > 1.09 or scale < 0.91) then
                        width = width * scale
                    end
                    
                    if width and width > 0 then
                        width = width + extra
                        if width < 200 then width = 200 end
                        aura_env.region:SetRegionWidth(width)
                    end
                end
            end
        end)
    end
end


elseif event == "TRAIT_CONFIG_UPDATED" then
    aura_env.dynamicWidth()
    local data = aura_env.dynamicWidthList
    if data.groupName then
        local name = data.groupName
        local extra = data.extra
        local aura_env = aura_env
        C_Timer.After(0.1, function()
            if not InCombatLockdown() and not WeakAuras.IsOptionsOpen() then
                local region = WeakAuras.GetRegion(name)
                if region then
                    local width = region.currentWidth
                    
                    local scale = region:GetScale()
                    if scale and (scale > 1.09 or scale < 0.91) then
                        width = width * scale
                    end
                    
                    if width and width > 0 then
                        width = width + extra
                        if width < 200 then width = 200 end
                        aura_env.region:SetRegionWidth(width)
                    end
                end
            end
        end)
    end
end

aura_env.sortAndOffset = function()
    aura_env.dynamicWidth()
    local data = aura_env.dynamicWidthList
    if data.groupName then
        local name = data.groupName
        local extra = data.extra
        local aura_env = aura_env
        C_Timer.After(0.1, function()
            if not InCombatLockdown() and not WeakAuras.IsOptionsOpen() then
                local region = WeakAuras.GetRegion(name)
                if region then
                    local width = region.currentWidth
                    
                    local scale = region:GetScale()
                    if scale and (scale > 1.09 or scale < 0.91) then
                        width = width * scale
                    end
                    
                    if width and width > 0 then
                        width = width + extra
                        if width < 200 then width = 200 end
                        aura_env.region:SetRegionWidth(width)
                    end
                end
            end
        end)
    end
end




function(a, event, unit, ...)
    if event == "OPTIONS" then
        local currentSpec = GetSpecialization()
        
        for i = 1, 5 do
            a[i] = {
                changed = true,
                show = true,
                name = aura_env.FormatCount(i, 4.5, 0),
                progressType = "static",
                total = 1, 
                value = i == 5 and 0.5 or 1,
                index = i,
                doomActive = false,
                spec = currentSpec,
            }
        end
        
        local aura_env = aura_env
        return true
    end
    
    if unit and unit ~= "player" 
    or event == "UNIT_POWER_UPDATE" and (...) ~= "SOUL_SHARDS"
    then return true end
    
    local e = aura_env
    local c = e.config
    local math = math
    
    if event == "PLAYER_SPECIALIZATION_CHANGED"
    or event == "PLAYER_ENTERING_WORLD" then 
        e.currentSpec = e.SpecUpdate(GetSpecialization())
    end
    
    if event == "UNIT_SPELLCAST_START" and unit == "player" then
        local _, spellID = ...
        local SpellCost = GetSpellPowerCost(spellID)[1]
        
        if SpellCost and SpellCost.type == 7 then
            e.cost = SpellCost.cost
            e.consuming = e.cost
        end
        if spellID == 29722 then --incinerate
            e.cost = -0.4
            e.consuming = -0.4
        elseif spellID == 686 then --shadow bolt
            e.cost = -1
            e.consuming = -1
        elseif spellID == 264178 then --demonbolt
            e.cost = -2
            e.consuming = -2
        elseif spellID == 265187 then --summon demonic tyrant
            e.cost = -5
            e.consuming = -5
        end
        
    end
    if event == "UNIT_SPELLCAST_STOP" and unit == "player" then
        e.cost = 0
        e.consuming = 0
    end
    
    local shards = UnitPower("player", 7, true)*0.1
    
    if not IsSpellKnown(116858) then shards = math.floor(shards) end
    
    local frags = shards - math.floor(shards)
    e.consuming = shards >= e.cost and e.cost or shards
    local remains = shards - e.cost
    
    for i = 1, 5 do
        --Casting prediction cost
        local min, max = 0, 0
        if e.cost > 0 and i > remains and i < math.min(shards - 0.01) + 1 then
            if frags == 0 or shards - e.consuming > remains and e.consuming > 1 then
                min, max = 0, 1
            elseif shards - e.consuming == remains then
                min, max = remains - math.floor(remains), 1
            else
                min, max = 0, e.consuming
            end
            e.consuming = e.consuming - (max - min)
        end
        
        --Casting prediction gain
        if e.cost < 0 and i == math.floor(shards)+1 then
            min = frags
            max = math.min(5, frags-e.cost)
            if max > 1 then
                max = math.floor(max)
            end
        end
        
        --if shards-e.cost > 5 then e.cost = 0 end
        
        a[i] = a[i] or {}
        a[i].totalPower = shards
        a[i].show = true
        a[i].changed = true
        a[i].progressType = "static"
        a[i].value = shards >= i and 1 or shards + 1 > i and frags or 0
        a[i].total = 1
        a[i].index = i
        a[i].name = e.FormatCount(i, shards, e.cost)
        a[i].spec = e.currentSpec
        a[i].additionalProgress = {
            [1] = {min = min, max = max}
        }
        a[i].consuming = e.consuming > 0
        a[i].full = shards == 5
        a[i].doomActive = false
    end     
    
    if c.TrackDoom and shards < 5 then
        local i = shards + 1
        local now = GetTime()
        for _, info in e.orderedDoom(e.Doom, e.nextDoom) do
            if i <= 5 and info.dur > 0 and info.exp > now then
                a[i].show = true
                a[i].progressType = "timed"
                a[i].duration = info.dur
                a[i].expirationTime = info.exp
                a[i].nature = info.dur < info.curTickDuration and "partial" or "full"
                a[i].doomActive = true
                a[i].changed = true
                i = i + 1
            end
        end
    end
    
    if event == "TRAIT_CONFIG_UPDATED" then
        aura_env.dynamicWidth()
        local data = aura_env.dynamicWidthList
        if data.groupName then
            local name = data.groupName
            local extra = data.extra
            local aura_env = aura_env
            C_Timer.After(0.1, function()
                    if not InCombatLockdown() and not WeakAuras.IsOptionsOpen() then
                        local region = WeakAuras.GetRegion(name)
                        if region then
                            local width = region.currentWidth
                            
                            local scale = region:GetScale()
                            if scale and (scale > 1.09 or scale < 0.91) then
                                width = width * scale
                            end
                            
                            if width and width > 0 then
                                width = width + extra
                                if width < 200 then width = 200 end
                                aura_env.region:SetRegionWidth(width)
                            end
                        end
                    end
            end)
        end
    end
    return true
end


